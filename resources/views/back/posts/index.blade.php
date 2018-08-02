@extends('back.index')

@section('title')
    {{ trans('sub.list_post') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ trans('sub.list_posts') }}</h1>
                <!-- <div class="box-header with-border">
                    <strong>@lang('Type') :</strong> &nbsp;
                    <input type="checkbox" name="new" @if(request()->post) checked @endif> @lang('Posts')&nbsp;
                    <input type="checkbox" name="active" @if(request()->question) checked @endif> @lang('Questions')&nbsp;
                    <div id="spinner" class="text-center"></div>
                </div> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="admin/dashboard">{{ trans('sub.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('sub.posts') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2 ">
            <div class="col-sm-12  row justify-content-center align-items-center">
                <a href="{{route('posts.create') }}" class="btn-success btn" style="float: right;"><i class="fa fa-plus" ></i></a>
            </div><!-- /.col -->
            <div class="col-sm-12">
                @if(count($errors) > 0)
                    <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #EE7C60 !important; font-size: 14px; margin-top: 10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach()
                        </strong>
                    </div>
                @endif
                @if(session('message'))
                    <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #7DF5B4 !important; font-size: 14px; margin-top: 10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('message')}}</strong>
                    </div>
                @endif
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="list-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{ trans('sub.topic') }}</th>
                                <th>{{ trans('sub.title') }}</th>
                                <th>{{ trans('sub.image') }}</th>
                                <th>{{ trans('sub.creation') }}</th>
                                <th>{{ trans('sub.active') }}</th>
                                <th>{{ trans('sub.tags') }}</th>
                                <th>{{ trans('sub.seo_title') }}</th>
                                <th>{{ trans('sub.detail') }}</th>
                                <th>{{ trans('sub.update') }}</th>
                                <th>{{ trans('sub.delete') }}</th>
                            </tr>
                            </thead>
                            @include('back.posts.table')
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('js')

<!-- page script -->
<script src="{{asset('js/backend/back.js')}}"></script>
<script>
    $(function () {
        $("#list-table").DataTable();
    });
</script>

@endsection
