@extends('front.index') 

@section('title')
    {{ trans('sub.add-post') }}
@endsection 

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>BKFA Team</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
	<!-- Main content -->
	<section class="content">
	    <div class="container-fluid">
            <div class="row">
                <div class="col-md-9"> 
                	<!-- form start -->
                	{!! Form::model($post, ['method' => 'POST', 'route' => ['home.posts.update', $post->id], 'files' => true,'enctype'=>'multipart/form-data' ]) !!}
            			{{ method_field('PUT') }}
	                	<!-- general form elements -->
	                    <div class=" ">
	                        <div class="text-center">
	                            <h3 class="card-title"><strong>Chỉnh Sửa Bài Viết</strong></h3>
	                            <i  class="text-center">(bài viết của bạn càng chi tiết thì càng tiếp cận được nhiều người !!!)</i>
	                            <div class="row mb-2 ">
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
	                        </div>
	                        <!-- /.card-header -->
	                        <div class="card-body">

	                            <div class="form-group">
	                                {!! Form::label( 'Topic: ') !!}
	                                {!! Form::select('topic_id', $topics, null, ['class' => 'form-control select2', 'placeholder' => '--- Select Topic ---']) !!}
	                            </div>

	                            <div class="form-group">
	                                {!! Form::label( 'Title: ') !!}
	                                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Please enter Title']) !!}
	                            </div>

	                            <div class="form-group hide">
	                                {!! Form::label( 'Slug: ') !!}
	                                {!! Form::text('slug_title', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Slug ...']) !!}
	                            </div>

	                            <div class="form-group hide">
	                                <label>{{ trans('sub.status') }}</label>
	                                <div class="form-check">
	                                    <input class="form-check-input" type="checkbox" value="1" name="active" {{ $post->active ? 'checked' : ''}}>
	                                    <label class="form-check-label">{{ trans('sub.active') }}</label>
	                                </div>
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
	                                <label>Ảnh</label>
	                                <br>
	                                <label>
	                                    <input type="file" class="form-control" name="img" id="file" />
	                                </label>
	                                <div id="status_upload"></div>
	                                <div class="preview">
	                                    <div class="imgpreview" align="center">
	                                    	@if($post->url_img != null)
	                                    		<img id="previewing" src="/upload/posts/{{$post->url_img}}"  class="img-fluid" />
	                                    	@else
	                                    		<img id="previewing" src=""  class="img-fluid" />
	                                    	@endif
	                                        
	                                    </div>
	                                    <div class="message text-center"></div>
	                                </div>
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
	                    <div class="row justify-content-center align-items-center">
			                <button type="submit" class="btn btn-primary">{{ trans('sub.update') }} <i class="fa fa-location-arrow"></i></button>
			                <button type="reset" class="btn btn-primary"  style="margin-left: 30px;">{{ trans('sub.reset') }} <i class="fa fa-refresh"></i></button>
			            </div>
	             		{!! Form::close() !!}
               	 	</div>
	                <!-- /.col -->
	                <div class="col-md-3">
	                    @include('front.partials.hot-post')
	                </div>
	            </div>
	            <!-- /.row -->
	    </div><!-- /.container-fluid --> 
	    <br><br>
	</section>
	<!-- /.content -->
</div>  
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