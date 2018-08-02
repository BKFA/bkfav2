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
        			{!! Form::open(['method' => 'POST', 'route' => 'home.posts.store', 'files' => true,'enctype'=>'multipart/form-data']) !!}
	                	<!-- general form elements -->
	                    <div class=" ">
	                        <div class="text-center">
	                            <h3 class="card-title"><strong>Nhập Nội Dung Bài Viết</strong></h3>
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
	                                {!! Form::label( 'Status: ') !!}
	                                <div class="form-check">
	                                    {!! Form::checkbox('active', '1', false, ['class' => 'form-check-input']) !!}
	                                    {!! Form::label(null, 'Active ', ['class'=>'form-check-label']) !!}
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                {!! Form::label( 'Tag: ') !!}
	                                {!! Form::select('tag_id[]', $tags, null, ['multiple' => true, 'class' => 'form-control tags', 'data-placeholder' => 'Select a Enter Tag']) !!}
	                            </div>
	                            
	                            <div class="form-group">
	                                {!! Form::label( 'Add Tag: ') !!}
	                                {!! Form::text('tags', null, ['id' => 'tags', 'class' => 'form-control', 'placeholder' => 'Please enter Tag']) !!}
	                            </div>
	                            
	                            <div class="form-group">
	                                {!! Form::label( 'Image: ') !!}
	                                <br>
	                                <div class="input-group">
	                                    {!! Form::file('img', ['id' => 'file', 'class' => 'form-control'] ) !!} 
	                                   <!--  <input type="file" class="form-control" name="img" id="file" /> -->
	                                    <div id="status_upload"></div>
	                                </div>
	                                <div class="preview">
	                                    <div class="imgpreview" align="center">
	                                        <img id="previewing" src=""  class="img-fluid" />
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
			                <button type="submit" class="btn btn-primary">{{ trans('sub.create') }} <i class="fa fa-location-arrow"></i></button>
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