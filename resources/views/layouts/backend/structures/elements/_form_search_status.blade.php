<div class="my-select2">
    <select class="my-select2__select2 select2-teacher select2-teacher-wrapper select2-wrapper" name="status">
        <option selected readonly value="-1">--- Status ---</option>
        <option value="{{ statusOn() }}" {{ !is_null(request('status')) && (int)request('status') === statusOn() ? "selected" : "" }}>{{ statusOnAlias() }}</option>
        <option value="{{ statusOff() }}" {{ (int)request('status') === statusOff() ? "selected" : "" }}>{{ statusOffAlias() }}</option>
    </select>
</div>