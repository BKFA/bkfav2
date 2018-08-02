@foreach($comments as $comment)
	<div class="card-comment">
	    <!-- User image -->
	    <img class="img-circle img-sm" src="/upload/users/{{$comment->user->avata}}" alt="User Image">
	    <div class="comment-text">
	        <span class="username">
	            {{ $comment->user->name }}
	            <span class="text-muted">{{ ucfirst (utf8_encode ($comment->created_at->formatLocalized('%A %d %B %Y, %I:%M:%S %p'))) }}
	            </span>
	            @if(Auth::check() && Auth::user()->name == $comment->user->name)
	                <a href="#" class="fa fa-cog text-muted float-right" style="margin-top: 10px;" data-toggle="dropdown"></a>
	                <div class="dropdown-menu text-center" style="font-size: 14px;">
	                    <a class="dropdown-item border-bottom deletecomment" href="javascript:void(0)"><span class="fa fa-trash "> Delete</a>
	                   <form action="{{ route('front.comments.destroy', [$comment->id]) }}" method="POST" class="hide">
	                        {{ csrf_field() }}
	                        {{ method_field('DELETE') }}
	                    </form>
	                   <a class="dropdown-item editcomment"  id="comment-edit{!! $comment->id !!}" href="#"><span class="fa fa-pencil" ></span> Edit</a>
	                </div>
	            @endif
	        </span>
	        <!-- /.username -->
	        <p id="cmt_content{!! $comment->id !!}">{{ $comment->content_cmt }}</p>
	    </div>
	    <!-- /.comment-text -->
	</div>
@endforeach
