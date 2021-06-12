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
                        <div class="card-body__head d-flex">
                            <h5 class="card-title">Add new post</h5>
                            <a href="{{backendRouter('post.list')}}">
                                <button type="button" class="btn btn-cyan btn-sm">Back</button>
                            </a>
                        </div>

                        <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="card">
                                <form class="form-horizontal store-update-entity" action="{{backendRouter('post.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    @include('layouts.backend.structures._error_validate')
                                    @include('layouts.backend.structures._notification')

                                    @include('backend.post._form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop