@extends('layouts.frontend.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">
                <div class="card-body p-4">

                    <div class="text-center w-75 m-auto">
                        <h3>{{ strtoupper(getSiteName()) }}</h3>
                        <p class="text-muted mb-4 mt-3">Login</p>
                    </div>

                    <form action="{{ frontendRouter('login.post') }}" method="POST">

                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')
                        @csrf

                        <div class="form-group mb-3">
                            <label for="emailaddress">Email *</label>
                            <input class="form-control" type="email" name="email" required="" placeholder="Enter your email" value="{{old('email')}}">
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection