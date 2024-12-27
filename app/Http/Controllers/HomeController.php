<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $searchValue = $request->get('searchValue', '');
        $sortField = $request->get('sort_field', 'updated_at');
        $sortDirection = $request->get('sort_direction', 'asc');

        $rates = ExchangeRate::where('currency_name',  'LIKE', '%' . $searchValue . '%')->orderBy($sortField, $sortDirection)->paginate(10);

        return view('home', compact('rates', 'sortField', 'sortDirection', 'searchValue'));

    }
}
