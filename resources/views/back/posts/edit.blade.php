@extends('back.index')

@section('title')
    {{ trans('sub.edit_post') }}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ trans('sub.update_post') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="admin/">{{ trans('sub.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('sub.update_post') }}</li>
                </ol>
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
                @if(session('warning'))
                    <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #EE7C60 !important; font-size: 14px; margin-top: 10px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>
                            {{session('warning')}}
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
        <!-- form start -->
        {!! Form::model($post, ['method' => 'POST', 'route' => ['posts.update', $post->id], 'files' => true,'enctype'=>'multipart/form-data' ]) !!}
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('sub.form_update') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label( 'Topic: ') !!}
                                {!! Form::select('topic_id', $topics, $post->topic_id, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label( 'Title: ') !!}
                                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Please enter Title']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label( 'Tag: ') !!}
                                {!! Form::select('tag_id[]', $tags, $post->tags, ['multiple' => true, 'class' => 'form-control tags', 'data-placeholder' => 'Select a Enter Tag']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label( 'Add Tag: ') !!}
                                <input class="form-control" type="text" placeholder="Please enter Tag" name="tags">
                            </div>

                            <div class="form-group">
                                {!! Form::label( 'Description: ') !!}
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows' => 5, 'cols' => 40, 'placeholder' => 'Please enter Description']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label( 'Content Post: ') !!}
                                {!! Form::textarea('content_post', null, ['id' => 'demo', 'class'=>'form-control ckeditor', 'rows' => 10, 'cols' => 40, 'placeholder' => 'Please enter Description']) !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                  <div class="col-md-4">
                    <!-- general form elements disabled -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('sub.sub_elements') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- text input -->
                            <div class="form-group">
                                {!! Form::label( 'Slug: ') !!}
                                {!! Form::text('slug_title', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Slug ...']) !!}
                            </div>

                            <div class="form-group">
                                <label>{{ trans('sub.status') }}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="active" {{ $post->active ? 'checked' : ''}}>
                                    <label class="form-check-label">{{ trans('sub.active') }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Ảnh</label>
                                <br>
                                <label>
                                    <input type="file" class="form-control" name="img" id="file" />
                                </label>
                                <div id="status_upload"></div>
                                <div class="preview">
                                    <div class="imgpreview" align="center">
                                        <img id="previewing" src="/upload/posts/{{$post->url_img}}"  class="img-fluid" />
                                    </div>
                                    <div class="message text-center"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('sub.seo') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- textarea -->
                            <div class="form-group">
                                {!! Form::label( 'Meta Description: ') !!}
                                {!! Form::textarea('meta_des', null, ['class'=>'form-control', 'rows' => 3, 'cols' => 40, 'placeholder' => 'Please enter Description SEO']) !!}

                            </div>
                            <div class="form-group">
                                {!! Form::label( 'Meta Keywords: ') !!}
                                {!! Form::textarea('meta_keyword', null, ['class'=>'form-control', 'rows' => 3, 'cols' => 40, 'placeholder' => 'Please enter meta keyword']) !!}

                            </div>
                            <!-- input states -->
                            <div class="form-group has-success">
                                <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> SEO Title</label>
                                {!! Form::textarea('seo_title', null, ['id' => 'inputSuccess', 'class'=>'form-control', 'rows' => 3, 'cols' => 40, 'placeholder' => 'Please enter Seo Title']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            <div class="card-footer row justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">{{ trans('sub.update') }} <i class="fa fa-location-arrow"></i></button>
                <button type="reset" class="btn btn-primary"  style="margin-left: 30px;">{{ trans('sub.reset') }} <i class="fa fa-refresh"></i></button>
            </div>
        {!! Form::close() !!}
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('js')
<!-- Validate Image -->
<script src="{{asset('js/blog.js')}}"></script>

<script>
    $(document).ready(function(){
        $(".tags").select2({
            tags: true
        });

    });

    $('#slug').keyup(function () {
        $(this).val(v.slugify($(this).val()))
    })

    $('#title').keyup(function () {
        $('#slug').val(v.slugify($(this).val()))
    })

</script>

@endsection
