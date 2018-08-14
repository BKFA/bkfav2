@extends('front.index') 

@section('title')
    {{ trans('sub.detail') }}
@endsection 

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: #ffff; min-height: 700px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TTB Blogs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-9">
          <div class="card-outline">
            <div class="">
                <div class="mailbox-controls">
                    @foreach ($post->tags as $tag)
                        <a class="btn btn-outline-primary btn-sm " href="{{ route('posts.tag', [$tag->id]) }}" style="padding: 0 5px 0 5px;">
                            <span class="fa fa-tag"></span> {{$tag->tag}}
                        </a>
                    @endforeach
                    <span class="float-right">
                        @include('front.partials.clap')
                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o mr-1"></i> Comments (10)</a>
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                    </span>
                </div>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-read-info">
                    <h5><strong>{{ $post->title }} </strong></h5>
                    <h6 style="margin-top: 10px;"><a href="#" ><img class="img-circle img-sm" src="/upload/users/{{$post->user->avata}}" alt="User Image" style="margin: -5px 5px 0 0;">  {{ $post->user->name }}</a>
                        <span class="mailbox-read-time float-right">{{ ucfirst (utf8_encode ($post->created_at->formatLocalized('%A %d %B %Y'))) }}</span>
                    </h6>
                </div>
                <div class="mailbox-read-message">
                    <p>{{ $post->description }}</p>
                    {!! $post->content_post !!}
                </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer">
                @include('front.partials.clap')
                <div class="float-right">
                    <span class="float-right">
                        <a href="#" class="link-black text-sm">
                            <i class="fa fa-comments-o mr-1"></i> {{ trans_choice(__('comment|comments'), $post->valid_comments_count) }} ({{ $post->valid_comments_count }})
                        </a>
                    </span>
                </div>
                <br><br>
                @if (Auth::check())
                    <form action="{{ route('posts.comments.store', [$post->id]) }}" method="post">
                        {{ csrf_field() }}
                        <img class="img-fluid img-circle img-sm" src="/upload/users/{{$post->user->avata}}" alt="Alt Text">
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
        <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">
            @include('front.partials.related', ['posts' => $post->related])
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
