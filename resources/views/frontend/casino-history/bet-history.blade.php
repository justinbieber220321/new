@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Bet History</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-box mb-0">
                        <h4 class="header-title mb-3">Bet History</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>From Users</th>
                                    <th>Message</th>
                                    <th>Number (USDT)</th>
                                    <th>Time Insert</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>user3@gmail.com</td>
                                    <td>f4a225f33e76751425599f03325c1fac0bbeeb73ef36985c97da52c88c72ae01</td>
                                    <td>5</td>
                                    <td>2021-06-16 14:28:20</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>user2@gmail.com</td>
                                    <td>4b82ee351b825744b7ff8f560e34c09ea40ffa2a1bd11aab0d94750b2305857a</td>
                                    <td>5</td>
                                    <td>2021-06-16 11:36:46</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection