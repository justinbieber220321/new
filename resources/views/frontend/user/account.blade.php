@extends('layouts.frontend.main')

@push('style')
    <link href="{{ asset('frontend/css/user.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('frontend/js/user.js') }}"></script>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Label</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Name</td>
                                    <td>{{ frontendCurrentUser()->username }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">2</th>
                                    <td>Email</td>
                                    <td>{{ frontendCurrentUser()->email }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">3</th>
                                    <td>Phone</td>
                                    <td>{{ frontendCurrentUser()->phone }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">4</th>
                                    <td>Address</td>
                                    <td>{{ frontendCurrentUser()->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br>

                    <a href="{{ frontendRouter('account.update.get') }}" class="btn btn-soft-secondary  btn-xs sw-btn-next">Update Profile</a>
                    <a href="{{ frontendRouter('account.update-password.get') }}" class="btn btn-soft-secondary  btn-xs sw-btn-next">{{ transF('btn.update-password') }}</a>
                    <a href="{{ frontendRouter('account.update-avatar.get') }}" class="btn btn-soft-secondary  btn-xs sw-btn-next">{{ transF('layout.sidebar.update-avatar') }}</a>
                </div>
            </div>

        </div>
        </div>
    </div>

@endsection