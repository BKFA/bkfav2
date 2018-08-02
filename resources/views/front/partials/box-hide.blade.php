<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="/upload/users/{{Auth::user()->avata}}" alt="User profile picture" style="height: 100px;">
            </div>
            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
            <p class="text-center">{{ Auth::user()->about }}</p>
            @php 
                $count = Auth::user()->countFollowing(Auth::user()->id); 
            @endphp
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Posts <span class="float-right badge bg-primary">{{ Auth::user()->point }}</span>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Followers <span class="float-right badge bg-info">{{ $count[0]->count }}</span>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Following <span class="float-right badge bg-success">{{ Count(Auth::user()->follows) }}</span>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="form-profile">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-12">
                <div class="skill" style="padding: 10px;">
                    <label>
                        <span class="fa fa-user-secret"></span><b> Skills: </b>
                        <i style="font-size: 14px;"> {{ Auth::user()->skill }}</i>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-12 row justify-content-center align-items-center">
                <a href="{{ route('front.user.show', [Auth::user()->id]) }}" class="btn btn-primary btn-sm"><span class="fa fa-user"></span> Profile</a>
                <!--  <button type="submit" class="btn btn-danger btn-sm" style="margin-left: 10px;"><span class="fa fa-sign-out"></span> Logout</button> -->
                <a class="dbtn btn-danger btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="margin-left: 10px; padding: 5px;">
                    <span class="fa fa-sign-out"></span>
                    Log out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</aside>