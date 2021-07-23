@extends('layouts.frontend.main')

@push('style')
    <style>
        input[name='email2']:focus {
            outline: none;
        }

        input[name='email2'] {
            height: 25px;
            background: none;
            color: white;
            border: 1px solid #ccc;
            width: 250px;
        }
    </style>
@endpush

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

                @include('layouts.frontend.structures._notification')

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>

                    <p class="text-muted mb-2 font-13">
                        <strong>UserID:</strong> <span class="ml-2">{{ $user->user_id }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>UserName:</strong> <span class="ml-2">{{ $user->username ? $user->username : extractNameFromEmail($user->email) }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>Email 1:</strong> <span class="ml-2">{{ $user->email }}</span></p>

                    <div class="text-muted mb-2 font-13 d-flex align-items-center">
                        <strong class="mr-2">Email 2:</strong>
                        <form action="{{ frontendRouter('account.update-email2') }}" method="post" class="form-inline">
                            <input type="email" required class="mr-1" name="email2" value="{{ $user->email2 }}">
                            @csrf
                            <button style="border: none;" type="submit"
                                    onclick="return confirm('Cập nhật email2. Bạn có chắc không?')"
                                    class="btn btn-xs btn-danger"
                            >
                                Update
                            </button>
                        </form>
                    </div>

                    <p class="text-muted mb-2 font-13">
                        <strong>Balance:</strong> <span class="ml-2">{{ formatPriceCurrency( getBalanceRealtime() ) }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>Parent User Id:</strong> <span class="ml-2">{{ $user->parent_id }}</span></p>

                    <p class="text-muted mb-2 font-13">
                        <strong>Player Code:</strong> <span class="ml-2">{{ $user->player_code }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection