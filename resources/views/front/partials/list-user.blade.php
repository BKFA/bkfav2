@foreach($users as $user)
    @php
        $count = $user->countFollowing($user->id);
    @endphp
    <div class="col-md-4" style="padding: 10px;">
        <!-- Widget: user widget style 2 -->
        <div class=" card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header badge-default">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="/upload/users/{{$user->avata}}" alt="User Avatar" style="margin-right: 10px;">
                </div>
                <!-- /.widget-user-image -->
                <div>
                    <strong class="username"> <a href="{{ route('front.user.show', [$user->id]) }}">{{ $user->name }}</a></strong><br>
                    <small class="email">{{ $user->email }}</small><br>
                    <small>{{ $user->education }}</small>
                </div>
            </div>
            <div class=" p-0">
                <ul class="footer_labels">
                    <li><a class="btn btn-outline-primary btn-sm " href="" style="padding: 0 3px 0 3px">Posts | {{ $user->point }}</span></a>
                    </li>
                    <li><a class="btn btn-outline-primary btn-sm " href="" style="padding: 0 3px 0 3px">Follwing | {{ $user->follows_count }}</span></a>
                    </li>
                    <li>
                    @guest
                        <a class="btn btn-outline-primary btn-sm " href="{{ route('login') }}" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="Follow" > Follow | {{ $count[0]->count }}
                        </a>
                    @else
                        @if (Auth::User()->isFollowing($user->id))
                            <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-primary btn-sm " type="submit" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="UnFollow" id="delete-follow-{{ $user->target_id }}">
                                    Follow  | {{ $count[0]->count }}
                                </button>
                            </form>
                        @else
                            <form action="{{url('follow/' . $user->id)}}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-outline-primary btn-sm " type="submit" style="padding: 0 5px 0 5px;"  data-toggle="tooltip" title="Follow" id="follow-user-{{ $user->id }}" >
                                    Follow | {{ $count[0]->count }}
                                </button>
                            </form>
                        @endif
                    @endguest
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <!-- /.col -->
@endforeach