@push('script')
    <script src="/backend/js/pages/user.js"></script>
@endpush

@push('styles')
    <link href="/backend/css/pages/user.css" rel="stylesheet">
@endpush

<div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username <span
                            class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" value="{{ $entity->username }}"
                           placeholder="Please enter username" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 text-right control-label col-form-label">Email <span
                            class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="email" value="{{ $entity->email }}"
                           placeholder="Please enter email" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control phone-inputmask" name="phone" id="phone-mask"
                           value="{{ $entity->phone }}" placeholder="Please enter phone">
                </div>
            </div>

            {{--<div class="form-group row">--}}
            {{--<label for="password" class="col-sm-3 text-right control-label col-form-label">--}}
            {{--Mật khẩu--}}
            {{--@if(!$entity->getKey())--}}
            {{--<span class="text-danger">(*)</span>--}}
            {{--@endif--}}
            {{--</label>--}}
            {{--<div class="col-sm-8">--}}
            {{--<input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>

        <div class="col-sm-6">
            @include('layouts.backend.structures.elements._status_form')
            @include('layouts.backend.structures.elements._gender_form')
            <div class="form-group row">
                <label for="date_of_birth" class="col-sm-3 text-right control-label col-form-label">Birthday</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" value="{{ $entity->birthday }}" name="birthday"
                           placeholder="Please enter birthday">
                </div>
            </div>

        </div>
    </div>
</div>
<div class="border-top">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group row">
                    <label for="email" class="col-sm-3 text-right control-label col-form-label"></label>
                    <div class="col-sm-8">
                        @include('layouts.backend.structures.elements._btn_submit_auth')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
