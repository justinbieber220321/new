@extends('layouts.frontend.main')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Test send mail</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('test-send-mail.post') }}" method="POST">

                                    @include('layouts.frontend.structures._notification')
                                    @include('layouts.frontend.structures._error_validate')
                                    @csrf

                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </div>

                                    <button class="btn btn-crown" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection