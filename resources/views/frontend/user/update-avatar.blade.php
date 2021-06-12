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
                    <h4 class="page-title">Update Avatar</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="wizard_Service" class="tab-pane" role="tabpanel" style="display: block;">
                                <form action="{{ frontendRouter('account.update-avatar.post') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @include('layouts.frontend.structures._notification')
                                    @include('layouts.frontend.structures._error_validate')
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">{{ transF('form.avatar') }} *</label>
                                                <div class="form-input-wrapper">
                                                    <div class="img-thumbnail-wrapper">
                                                        <input type="file" id="upload" name="avatar"
                                                               style="display: none">
                                                        @if (frontendCurrentUser()->avatar)
                                                            <img src="{{ asset(frontendCurrentUser()->avatar) }}"
                                                                 class="img-thumbnail" style="width: 200px;">
                                                        @else
                                                            <img src="{{ asset(getPathImageDefault()) }}"
                                                                 class="img-thumbnail" style="width: 200px">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="toolbar toolbar-bottom" role="toolbar">
                                                @include('theme.structures._btn_submit')
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection