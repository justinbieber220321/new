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
                    <h4 class="page-title">Update Profile</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ frontendRouter('account.update.post') }}" method="post">
                                @csrf
                                @include('layouts.frontend.structures._notification')
                                @include('layouts.frontend.structures._error_validate')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>{{ transF('form.name') }} *</label>
                                        <input type="text" name="username" value="{{ $entity->username }}" required
                                               class="form-control" placeholder="{{ transMessage('placeholder_', ['field' => transF('form.name')]) }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ transF('form.email') }} *</label>
                                        <input type="email" name="email" value="{{ $entity->email }}" required
                                               class="form-control" placeholder="{{ transMessage('placeholder_', ['field' => transF('form.email')]) }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ transF('form.phone') }}</label>
                                        <input type="text" name="phone" class="form-control"
                                               placeholder="{{ transMessage('placeholder_', ['field' => transF('form.phone')]) }}" value="{{ $entity->phone }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ transF('form.address') }}</label>
                                        <input type="text" name="address" class="form-control"
                                               placeholder="{{ transMessage('placeholder_', ['field' => transF('form.address')]) }}" value="{{ $entity->address }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{ transF('form.birthday') }}</label>
                                        <input type="date" name="birthday" class="form-control"  value="{{ $entity->birthday }}" id="example-date-input">
                                    </div>
                                </div>

                                <br>

                                <a href="{{ frontendRouter('account') }}" class="btn btn-soft-secondary btn-xs"><i class="fa fa-arrow-left"></i> {{ transF('btn.back') }}</a>
                                @include('theme.structures._btn_submit')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection