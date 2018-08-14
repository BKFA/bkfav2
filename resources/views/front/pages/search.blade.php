@extends('front.index') 

@section('title')
    {{ trans('sub.result-search') }}
@endsection 

@section('content')
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
                        <li class="breadcrumb-item"><a href="#"></a></li>
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
                    <div>
                        <div class="box-tabs">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active btn-outline-info" href="#activity" data-toggle="tab">Search</a></li>
                            </ul>
                            @include('front.partials.add-question')
                        </div>
                        <!-- /.card-header -->
                        <div class="container-fluid">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="row">
                                        @foreach($posts as $post)
                                        @php
                                            $count = $post->user->countFollowing($post->user->id);
                                        @endphp
                                            <!-- post -->
                                            <div class="col-md-12">
                                                    <!-- Box Comment -->
                                                    <div class="card card-widget">
                                                        <div class="card-header">
                                                            <div class="user-block">
                                                                <img class="img-circle" src="/upload/users/{{$post->user->avata}}" alt="User Image">
                                                                <span class="username"><a href="#">{{$post->user->name}}</a>
                                                                    <span>&nbsp&nbsp
                                                                        @guest
                                                                            <a class="btn btn-outline-primary btn-sm " href="{{ route('login') }}" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="Follow" >
                                                                                <span class="fa fa-user-plus"></span> {{ $count[0]->count }}
                                                                            </a>
                                                                        @else
                                                                            @if (Auth::User()->isFollowing($post->user->id))
                                                                                <form action="{{url('unfollow/' . $post->user->id)}}" method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('DELETE') }}
                                                                                    <button class="btn btn-primary btn-sm " type="submit" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="UnFollow">
                                                                                        <span class="fa fa-user-plus"></span> {{ $count[0]->count }}
                                                                                    </button>
                                                                                </form>
                                                                            @else
                                                                                <form action="{{url('follow/' . $post->user->id)}}" method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    <button class="btn btn-outline-primary btn-sm " type="submit" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="Follow">
                                                                                        <span class="fa fa-user-plus"></span> {{ $count[0]->count }}
                                                                                    </button>
                                                                                </form>
                                                                            @endif
                                                                        @endguest
                                                                    </span>
                                                                </span>
                                                                <span class="description">{{ $post->updated_at->formatLocalized('%A %d %B %Y, %I:%M:%S %p') }}</span>   
                                                            </div>
                                                            <!-- /.user-block -->
                                                            <div class="card-tools">
                                                                @include('front.partials.clap')
                                                                @if(Auth::check() && Auth::user()->name == $post->user->name)
                                                                    <a href="{{ route('home.posts.edit', [$post->id]) }}" title="Update">
                                                                        <button type="button" class="btn btn-tool"><i class="fa fa-pencil-square-o"></i></button>
                                                                    </a>
                                                                    <button type="button" title="Delete" class="btn btn-tool" data-toggle="modal" data-target="#delModal{{$post->id}}"> <i class="fa fa-trash-o"></i></button>
                                                                    @include('front.partials.delete-post')
                                                                    @else
                                                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                @endif
                                                            </div>
                                                            <!-- /.card-tools -->
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <!-- /.user-block -->
                                                              <div class="row mb-3">
                                                                <div class="col-sm-12">
                                                                    <h5><a href="{{ url('posts/' . $post->slug_title) }}">{{$post->title}}</a></h5>
                                                                    <p>{!! $post->description !!}
                                                                        @if(strlen($post->content_post) < 2000)
                                                                            <a href="javascript:void(0)"  id="read-more{{$post->id}}" onclick="readMore({{$post->id}})">... more</a>
                                                                        @else
                                                                            <a href="{{ url('posts/' . $post->slug_title) }}">... more</a>
                                                                        @endif
                                                                    </p>
                                                                    @if($post->url_img != null)
                                                                        <a target="_blank" href="/upload/posts/{{$post->url_img}}" class="row justify-content-center align-items-center">
                                                                            <img src="/upload/posts/{{$post->url_img}}" alt="Forest" class="img-fluid mb-3" style="width:300px">
                                                                        </a>
                                                                     @endif
                                                                    <div style="display: none;" id="content{{$post->id}}">
                                                                        <div>
                                                                            <div>@php echo($post->content_post) @endphp</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.col -->
                                                                </div>
                                                              <!-- /.row -->
                                                            <!-- Social sharing buttons -->
                                                            <a href="#" class="link-black text-sm"><i class="fa fa-star mr-1 mr-1"></i> Rate ({{ $post->rate }})</a>
                                                            @foreach($post->tags as $tag)
                                                                <a class="btn btn-outline-primary btn-sm " href="{{ route('posts.tag', [$tag->id]) }}" style="padding: 0 5px 0 5px;">
                                                                    <span class="fa fa-tag"></span> {{$tag->tag}}
                                                                </a>
                                                            @endforeach
                                                            <span class="float-right">
                                                                <a href="#" class="link-black text-sm">
                                                                    <i class="fa fa-comments-o mr-1"></i> {{ trans_choice(__('comment|comments'), $post->valid_comments_count) }} ({{ $post->valid_comments_count }})
                                                                </a>
                                                            </span>
                                                        </div>
                                                        <!-- /.card-body -->
                                                        <div class="card-footer">
                                                            @if (Auth::check())
                                                                <form action="{{ route('posts.comments.store', [$post->id]) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <img class="img-fluid img-circle img-sm" src="/upload/users/{{Auth::user()->avata}}" alt="Alt Text">
                                                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                                                    <div class="img-push">
                                                                        <input type="text" class="form-control form-control-sm" placeholder="@lang('Press enter to post comment')" name="message" id="message" class="full-width" value="{{ old('message') }}" required>
                                                                    </div>
                                                                    @if ($errors->has('message'))
                                                                        @component('front.components.error')
                                                                            {{ $errors->first('message') }}
                                                                        @endcomponent
                                                                    @endif
                                                                </form>
                                                             @else
                                                                <em>@lang('You must be logged to add a comment !')</em>
                                                            @endif
                                                        </div>
                                                        <!-- /.card-footer -->
                                                        <!-- commentlist -->
                                                        @if ($post->valid_comments_count)
                                                            @php
                                                                $level = 0;
                                                                $comments = $post->parentComments->take(2);
                                                            @endphp
                                                            
                                                                <div class="card-footer card-comments">
                                                                    <div class="commentlist{{ $post->id }}">
                                                                        @include('front/comments/comments', ['comments' => $post->parentComments->take(2)])
                                                                    </div>

                                                                    @if ($post->parent_comments_count > config('app.numberParentComments'))
                                                                        <p id="morebutton{{$post->id}}" class="text-center" style="margin-top: 15px;">
                                                                            <a id="comment-more{!! $post->id !!}" class="nextcomments" href="{{ route('posts.comments', [$post->id, 1]) }}" class="button">@lang('More comments ...')</a>
                                                                        </p>
                                                                        <p id="moreicon{{$post->id}}" class="text-center hide">
                                                                            <span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            
                                                        @endif
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            <!-- /.post -->
                                        @endforeach
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.post -->
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
					<div style="padding: 10px;"></div>
					<!-- Tags -->
					<div class="card card-primary">
					    <div class="all-tags">
					        <div class="p-3 bg-white rounded box-shadow">
					            <h5 class="border-bottom border-gray pb-2 mb-0"> Related Tags</h5>
					            <ul class="footer_labels">
					            	@foreach($posts->tags as $tag)
					            		<li>
					                        <a class="btn btn-outline-primary btn-sm " href="{{ route('posts.tag', [$tag->id]) }}" style="padding: 2px 5px 2px 5px;">
					                            {{$tag->tag}} | <span class="fa fa-tag"></span> 
					                        </a>
					                    </li>
					            	@endforeach
					            </ul>
					        </div>
					    </div>
					</div>
					<!-- /.card -->
					<!-- hot post -->
					@include('front.partials.hot-post')
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