<div class="my-select2">
    <select class="my-select2__select2 select2-teacher select2-teacher-wrapper select2-wrapper" name="gender">
        <option selected readonly value="-1">--- Gender ---</option>
        <option value="{{ genderGirl() }}" {{ !is_null(request('gender')) && (int)request('gender') === statusOn() ? "selected" : "" }}>{{ getConfig('gender_alias.girl') }}</option>
        <option value="{{ genderBoy() }}" {{ (int)request('gender') === statusOff() ? "selected" : "" }}>{{ getConfig('gender_alias.boy') }}</option>
    </select>
</div>