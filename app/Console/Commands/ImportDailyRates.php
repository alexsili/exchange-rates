<?php

namespace App\Console\Commands;

use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportDailyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:import-daily-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import daily rates from BNM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $BNMUrl = 'https://www.bnm.md/ro/official_exchange_rates?get_xml=1&date='.date('d.m.Y');
            $response = Http::get($BNMUrl);

            if (!$response->successful()) {
                $this->error('Error retrieving data');
                return 1;
            }

            try {
                $xml = new \SimpleXMLElement($response->body());
                $BNMRateDate = (string) $xml['Date'];
                foreach ($xml->Valute as $rate) {

                    $currencyCode = $rate->CharCode;

                    ExchangeRate::updateOrCreate(
                        [
                            'currency_code' => $currencyCode,
                            'date' => Carbon::createFromDate($BNMRateDate)->format('Y-m-d'),
                        ],
                        [
                            'currency_name' => $rate->Name,
                            'rate' => $rate->Value,
                            'nominal' => $rate->Nominal,
                        ]
                    );
                }

                $this->info('Import dates was successfully done');


            } catch (\Exception $exception) {
                $this->error('Error: '.$exception->getMessage());
                return 1;
            }

        } catch (\Exception $exception) {
            $this->error('Error: '.$exception->getMessage());
            return 1;
        }
    }
}
