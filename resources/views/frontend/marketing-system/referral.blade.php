@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Marketing System</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-box mb-0">
                        <h4 class="header-title mb-3">
                            Link referral:
                            <a href="javascript:void(0)" id="text-copy">{{ env('LINK_REFERRAL') . frontendCurrentUser()->user_id }}</a>
                            &nbsp;&nbsp;<i class="mdi mdi-content-copy " id="icon-copy" title="Copy!"></i>
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 ">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-heart font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1">$<span
                                            data-plugin="counterup">{{ getBalanceRealtime() }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Balance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1">
                                    F1: <span data-plugin="counterup">{{ $countUserDirect }}</span> /
                                    Teams: <span data-plugin="counterup">{{ $countUser }}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">Total Network</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php $infoBet = getBet(frontendCurrentUser()) @endphp

            <div class="col-md-6 ">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ arrayGet($infoBet, 'myBet') }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">My bet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-eye font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ arrayGet($infoBet, 'totalTeamBet') - frontendCurrentUser()->team_bet_old }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Team bet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection