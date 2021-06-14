@extends('layouts.frontend.main')

@section('content')
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
        <div class="col-md-6">
            <div class="card-box">
                <img src="{{ asset('theme/image/profile/default-user.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>

                    <p class="text-muted mb-2 font-13">
                        <strong>UserID :</strong> <span class="ml-2">{{ $user->user_id }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>UserName :</strong> <span class="ml-2">{{ $user->username }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>Email :</strong> <span class="ml-2">{{ $user->email }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>Balance :</strong> <span class="ml-2">{{ formatPriceCurrency($user->balance) }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>Parent User Id :</strong> <span class="ml-2">{{ $user->parent_id }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection