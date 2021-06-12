@push('script')
    <script src="/backend/js/pages/post.js"></script>
@endpush

<div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="fname" class="col-sm-2 text-right control-label col-form-label">Title <span
                            class="text-danger">(*)</span></label>
                <div class="col-sm-8">
                    <input type="text" required class="form-control" name="title" maxlength="65" value="{{ $entity->title }}"
                           placeholder="Enter title up to 65 characters">
                </div>
            </div>

            @if ($entity->getKey())
                <div class="form-group row">
                    <label for="cono1" class="col-sm-2 text-right control-label col-form-label">Slug</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control" name="slug" maxlength="65" value="{{ $entity->slug }}"
                               placeholder="Enter slug up to 65 characters">
                    </div>
                </div>
            @endif

            <div class="form-group row">
                <label for="fname" class="col-sm-2 text-right control-label col-form-label">Meta title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="meta_title" maxlength="65" value="{{ $entity->meta_title }}"
                           placeholder="Enter meta-title to 65 characters">
                </div>
            </div>

            <div class="form-group row">
                <label for="fname" class="col-sm-2 text-right control-label col-form-label">Category</label>
                <div class="col-sm-8">
                    <div class="my-select2">
                        <select class="form-control" name="category_id">
                            <option value="{{ getConfig('parent_id_default') }}" {{is_null(request('parent_id')) ? 'selected' : ''}}>--- Please select ---</option>
                            @include('backend.category._form_select_category', ['categories' => $categories, 'parentId' => $entity->category_id])
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group row">
                <label for="cono1" class="col-sm-2 text-right control-label col-form-label">Meta desciption</label>
                <div class="col-sm-8">
                    <textarea rows="4" maxlength="255" name="meta_description" placeholder="Enter meta-description to 255 characters" class="form-control">{{ $entity->meta_description }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group row">
                <label for="content" class="col-sm-1 text-right control-label col-form-label">Content <span
                            class="text-danger">(*)</span></label>
                <div class="col-md-10">
                    <input name="content" type="hidden" value="{{$entity->content}}">
                    <div id="editor-quill"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="border-top">
    <div class="card-body">
        @include('layouts.backend.structures.elements._btn_submit_auth')
    </div>
</div>
