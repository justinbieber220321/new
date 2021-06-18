@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Casino Report</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-box mb-0">
                        <h4 class="header-title mb-3">Casino Report</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Number of bets</th>
                                    <th>Turnover</th>
                                    <th>Wins</th>
                                    <th>Ggr</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <th scope="row">{{ 1 + $key }}</th>
                                        <td>{{ arrayGet($item, 'number_of_bets') }}</td>
                                        <td>{{ arrayGet($item, 'turnover') }}</td>
                                        <td>{{ arrayGet($item, 'wins') }}</td>
                                        <td>{{ arrayGet($item, 'ggr') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection