@extends('layouts.backend.main')

@section('content')
<div class="content-page teacher-page">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Module post</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.backend.structures._notification')

                        <div class="card-body__head card-body__filter">
                            <h5 class="card-title bold">Filter</h5>
                        </div>

                        <!-- From search -->
                        <form method="GET" action="{{ backendRouter('post.list') }}" class="mb-5" id="form-search">
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <input type="text" name="title" class="form-control" placeholder="Tiêu đề" value="{{ request('title') }}">
                                </div>

                                <div class="col-sm-2">
                                    <div class="my-select2">
                                        <select class="form-control" name="category_id">
                                            <option value="{{ getConfig('parent_id_default') }}" {{is_null(request('parent_id')) ? 'selected' : ''}}>--- Please select ---</option>
                                            @include('backend.category._form_select_category', ['categories' => $categories, 'parentId' => request('category_id')])
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body__head card-body__filter text-center">
                                <button type="submit" class="btn btn-cyan btn-sm">Search</button>
                            </div>
                        </form>

                        <div class="card-body__head d-flex">
                            <h5 class="card-title">List post</h5>
                            <a href="{{backendRouter('post.create')}}">
                                <button type="button" class="btn btn-cyan btn-sm">Add new</button>
                            </a>
                        </div>

                        <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table class="table table-striped table-bordered dataTable" role="grid">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col" width="200px">Title</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($entities as $key => $entity)
                                    <tr>
                                        <td>{{ getSTTBackend($entities, $key) }}</td>
                                        <td>{{ $entity->title }}</td>
                                        <td>{{ $entity->slug }}</td>
                                        <td>{{ $entity->tryGet('category')->name }}</td>
                                        <td>
                                            <div class="comment-footer">
                                                <a href="{{ backendRouter('post.edit', ['id' => $entity->getKey()]) }}">
                                                    <button type="button" class="btn btn-cyan btn-xs">Sửa</button>
                                                </a>
                                                <a href="#modal_confirm_delete"
                                                   class="btn-danger btn btn-xs modal_confirm_delete rounded"
                                                   data-toggle="modal"
                                                   data-form-action="{{ backendRouter('post.destroy', ['id' => $entity->id]) }}"
                                                >
                                                    Xóa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $entities->appends(\Illuminate\Support\Facades\Input::all())->links('layouts.backend.structures._pagination')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
