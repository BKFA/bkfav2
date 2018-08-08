<div style="padding: 5px;"></div>
<div class="card-primary">
    <span class="hot badge-info navbar-badge" style="z-index: 100;">Hot Authors</span>
    <ul class="list-group">
        @foreach($users as $user)
            @php
                $count = $user->countFollowing($user->id);
            @endphp
            <li class="list-group-item">
                <div class="media w-100">
                    <img class="media-object img-circle elevation-1 img-fluid mr-3" src="/upload/users/{{$user->avata}}" width="30">
                    <div class="media-body align-self-center">
                        <strong class="username"> <a href="{{ route('front.user.show', [$user->id]) }}">{{ $user->name }}</a></strong><br>
                        <small class="email">{{ $user->email }}</small>
                        @guest
                            <a class="btn btn-outline-primary btn-sm " href="{{ route('login') }}" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="Follow" >
                                <span class="fa fa-user-plus"></span> {{ $count[0]->count }}
                            </a>
                        @else
                            @if (Auth::User()->isFollowing($user->id))
                                <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-primary btn-sm " type="submit" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="UnFollow" id="delete-follow-{{ $user->target_id }}">
                                        <span class="fa fa-user-plus"></span> {{ $count[0]->count }}
                                    </button>
                                </form>
                            @else
                                <form action="{{url('follow/' . $user->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-outline-primary btn-sm " type="submit" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="Follow" id="follow-user-{{ $user->id }}" >
                                        <span class="fa fa-user-plus"></span> {{ $count[0]->count }}
                                    </button>
                                </form>
                            @endif
                        @endguest
                    </div>
                </div>
            </li>
        @endforeach
        <li class="list-group-item text-center" style=" font-size: 15px; padding: 5px;">
            <a href="{{ route('front.user.index') }}">View All <span class="fa fa-angle-double-right"  style=" font-size: 12px;"></span></a>
        </li>
    </ul>
</div>
<div style="padding: 10px;"></div>
<!-- Tags -->
<div class="card card-primary">
    <div class="all-tags">
        <div class="p-3 bg-white rounded box-shadow">
            <h4 class="border-bottom border-gray pb-2 mb-0">Tag</h4>
            <ul class="footer_labels">
            	@foreach($tags as $tag)
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