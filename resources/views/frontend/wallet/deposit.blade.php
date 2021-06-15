@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Deposit</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ frontendRouter('deposit.post') }}" method="POST">

                                    @include('layouts.frontend.structures._notification')
                                    @include('layouts.frontend.structures._error_validate')
                                    @csrf

                                    <div class="form-group">
                                        <label>To *</label>
                                        <div class="my-select2">
                                            <select required class="my-select2__select2 select2-wrapper" name="user_id">
                                                <option selected readonly value="">--- Please select ---</option>
                                                @foreach($listAffiliates as $item)
                                                    <option value="{{ arrayGet($item, 'id') }}">{{ arrayGet($item, 'email') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Number (USDT) *</label>
                                        <input type="number" class="form-control" name="number" value="{{ old('number') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Message *</label>
                                        <input type="text" class="form-control" value="{{ old('message') }}" name="message" required maxlength="64">
                                    </div>

                                    <button class="btn btn-crown" type="submit">Log In</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection