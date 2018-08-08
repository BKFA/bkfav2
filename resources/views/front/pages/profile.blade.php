@extends('front.index') 

@section('title')
    {{ trans('sub.detail') }}
@endsection 

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
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
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                @guest
                                @else
                                    @if($user->id == Auth::User()->id)
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
                                    @endif
                                @endguest
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    @include('front/partials/home-list')
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="settings">
                                    @guest
                                    @else
                                        @if($user->id == Auth::User()->id)
                                            <!-- form start -->
                                            {!! Form::model($user, ['method' => 'POST', 'route' => ['front.user.update', $user->id], 'files' => true,'enctype'=>'multipart/form-data' ]) !!}
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('name', null, ['id' => 'inputName', 'class' => 'form-control', 'placeholder' => 'Please enter Name']) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName2" class="col-sm-2 control-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $user->address}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName2" class="col-sm-2 control-label">Birthday</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="birthday" max="3000-12-31" min="1000-01-01" class="form-control" value="{{ $user->birthday }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName2" class="col-sm-2 control-label">Job</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="job" placeholder="Job" value="{{ $user->job }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName2" class="col-sm-2 control-label">Education</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="education" placeholder="Education" value="{{ $user->education }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputExperience" class="col-sm-2 control-label">About</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="about" placeholder="About" >{{ $user->about }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="skill" placeholder="Skills" value="{{ $user->skill }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        @endif
                                    @endguest
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
                  <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @guest
                                <img class="profile-user-img img-fluid img-circle" src="/upload/users/{{$user->avata}}" alt="User profile picture">
                                @else
                                    @if($user->id == Auth::User()->id)
                                        <form enctype="multipart/form-data"  id="img-upload-form" method="POST" accept-charset="utf-8" onsubmit="return submitImageForm(this, {{Auth::user()->id}})">
                                            <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                            <img class="profile-user-img img-fluid img-circle" id="logo-img" onclick="document.getElementById('add-new-logo').click();" src="/upload/users/{{Auth::user()->avata}}" style="height: 100px;" />
                                            <span class="fa fa-instagram" style="font-size: 30px; position: absolute; margin-top: 70px; margin-left: -60px; z-index: 0;  opacity: 0.4;"></span>
                                            <input type="file" style="display: none" id="add-new-logo" name="file" accept="image/*" onchange="addNewLogo(this)"/>
                                        </form>
                                    @else
                                        <img class="profile-user-img img-fluid img-circle" src="/upload/users/{{$user->avata}}" alt="User profile picture">
                                    @endif
                                @endguest
                            </div>
                            <h3 class="profile-username text-center">{{$user->name}}</h3>
                            <p class="text-muted text-center">{{$user->about}}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    @php
                                        $count = $user->countFollowing($user->id);
                                    @endphp
                                    <b>Followers</b> <a class="float-right">{{ $count[0]->count }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">{{ Count($user->follows) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Posts</b> <a class="float-right">{{ $user->point }}</a>
                                </li>
                            </ul>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm btn-block"><b>Follow</b></a>
                            @else
                                @if (Auth::User()->isFollowing($user->id))
                                    <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-primary btn-sm btn-block" type="submit" data-toggle="tooltip" title="UnFollow">UnFollow
                                        </button>
                                    </form>
                                @else
                                    <form action="{{url('follow/' . $user->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-outline-primary btn-sm btn-block" type="submit" data-toggle="tooltip" title="Follow">Follow
                                        </button>
                                    </form>
                                @endif
                            @endguest
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- About Me Box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title row justify-content-center align-items-center"><strong>About</strong></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <i class="fa fa-book mr-1"></i> Education
                            <p class="text-muted">{{ $user->education }}</p>
                            <hr>
                            <i class="fa fa-map-marker mr-1"></i> Location
                            <p class="text-muted">{{ $user->address }}</p>
                            <hr>
                            <i class="fa fa-pencil mr-1"></i> Skills
                            <p class="text-muted">{{$user->skill }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
