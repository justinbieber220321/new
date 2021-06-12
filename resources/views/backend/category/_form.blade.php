<div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name category <span class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{ $entity->name }}" placeholder="Enter category name" required>
                </div>
            </div>

            @if ($entity->getKey())
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Slug <span class="text-danger">(*)</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="slug" required value="{{ $entity->slug }}" placeholder="Enter slug">
                    </div>
                </div>
            @endif

            <div class="form-group row">
                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent category</label>
                <div class="col-sm-8">
                    <div class="my-select2">
                        <select class="form-control" name="parent_id">
                            <option value="{{ getConfig('parent_id_default') }}" {{is_null(request('parent_id')) ? 'selected' : ''}}>--- Please select ---</option>
                            @include('backend.category._form_select_category', ['categories' => $categories, 'parentId' => $entity->parent_id])
                        </select>
                    </div>
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
                    <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                    <div class="col-sm-8">
                        @include('layouts.backend.structures.elements._btn_submit_auth')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
