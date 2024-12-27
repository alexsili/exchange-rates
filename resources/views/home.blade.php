@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Exchange rate BNM') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>

                        @endif
                        <form method="GET" action="{{ route('home') }}" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="searchValue" class="form-control" placeholder="Search by name"
                                       value="{{ request('searchValue') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <table class="table table-striped table-hover mt-2">
                            <thead class="table-dark">
                            <tr>
                                <th>
                                    <a href="{{ route('home', ['sort_field' => 'id', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'searchValue' => $searchValue ?? '']) }}">#</a>
                                </th>
                                <th>
                                    <a href="{{ route('home', ['sort_field' => 'currency_name', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'searchValue' => $searchValue ?? '']) }}">Name</a>
                                </th>
                                <th>
                                    <a href="{{ route('home', ['sort_field' => 'currency_code', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'searchValue' => $searchValue ?? '']) }}">Code</a>
                                </th>
                                <th>
                                    <a href="{{ route('home', ['sort_field' => 'rate', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'searchValue' => $searchValue ?? '']) }}">
                                        Exchange Rate
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('home', ['sort_field' => 'date', 'sort_direction' => $sortDirection === 'asc' ? 'desc' : 'asc', 'searchValue' => $searchValue ?? '']) }}">
                                        Last Update
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rates as $rate)
                                <tr>
                                    <td>{{ $rate->id }}</td>
                                    <td>{{ $rate->currency_name }}</td>
                                    <td>{{ $rate->currency_code }}</td>
                                    <td>{{ $rate->rate }}</td>
                                    <td>{{ $rate->date->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $rates->appends(['sort_field' => $sortField, 'sort_direction' => $sortDirection, 'searchValue' => $searchValue])->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

