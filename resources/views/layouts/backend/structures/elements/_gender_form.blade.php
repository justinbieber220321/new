<div class="form-group row">
    <label for="name" class="col-md-3 text-right control-label col-form-label">Gender</label>
    <div class="col-md-8">
        <div class="item_radio_select item_select_gender">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="gender1" name="gender" class="custom-control-input"
                       {{ $entity->gender == genderGirl() ? "checked" : '' }}
                       value="{{ genderGirl() }}">
                <label class="custom-control-label" for="gender1">{{ getConfig('gender_alias.girl') }}</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="gender2" name="gender" class="custom-control-input"
                       {{ $entity->gender == genderBoy() ? "checked" : '' }}
                       value="{{ genderBoy() }}">
                <label class="custom-control-label" for="gender2">{{ getConfig('gender_alias.boy') }}</label>
            </div>
        </div>
    </div>
</div>