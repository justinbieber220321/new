<div class="form-group row">
    <label for="name" class="col-md-3 text-right control-label col-form-label">Status</label>
    <div class="col-md-8">
        <div class="item_radio_select">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="status1" name="status" class="custom-control-input"
                       {{ $entity->status == statusOn() ? "checked" : '' }}
                       value="{{ statusOn() }}">
                <label class="custom-control-label" for="status1">{{ statusOnAlias() }}</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="status2" name="status" class="custom-control-input"
                       {{ $entity->status == statusOff() ? "checked" : '' }}
                       value="{{ statusOff() }}">
                <label class="custom-control-label" for="status2">{{ statusOffAlias() }}</label>
            </div>
        </div>
    </div>
</div>