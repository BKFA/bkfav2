@extends('back.index') 

@section('title')
	{{ trans('sub.list_topic') }}
@endsection 

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ trans('sub.list_topics') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="admin/dashboard">{{ trans('sub.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('sub.topics') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2 ">
            <div class="col-sm-12  row justify-content-center align-items-center">
                <button type="button" class="btn-success btn" style="float: right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" ></i></button>

                @include('back.topics.create')

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
						<table id="example1" class="table table-bordered">
							<thead>
							<tr>
								<th>{{ trans('sub.name') }}</th>
								<th>{{ trans('sub.slug') }}</th>
								<th>{{ trans('sub.update') }}</th>
								<th>{{ trans('sub.delete') }}</th>
							</tr>
							</thead>
							@if(sizeof($topics) > 0)
            					@foreach($topics as $topic)
            					<tr>
									<td>{{ $topic->name_topic}}</td>
									<td>{{ $topic->slug_topic}}</td>
									<td>
										<div class="m-sm-auto ">
												<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal{{ $topic->id}}"><span class="fa fa-edit"></span>	
												</button>
												@include('back.topics.edit')
										</div>
									</td>            
									<td>
										<div class="m-sm-auto">
											<button type="button" title="Delete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal{{$topic->id}}"> <span class="fa fa-trash"></span>	
											</button>
											@include('back.topics.delete')
										</div>
									</td>
								</tr>
            					@endforeach
            				@endif
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
<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

@endsection
