<!-- Navbar -->
<nav class="navbar navbar-expand fixed-top bg-info navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">{{ trans('sub.home') }}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home.contact.create') }}" class="nav-link">Contact</a>
        </li>
    </ul>
    <form action="{{ route('switchLang') }}" class="form-lang form-inline ml-3" method="post">
        <select name="locale" onchange='this.form.submit();'>
            <option value="en">{{ trans('sub.lang.en') }}</option>
            <option value="vi"{{ Lang::locale() === 'vi' ? 'selected' : '' }}>{{ trans('sub.lang.vi') }}</option>
        </select>
        {{ csrf_field() }}
    </form>

    <!-- SEARCH FORM -->
    <div class="header_search2">
        <form role="search" method="get" class="form-inline ml-3 search-form" action="{{ route('posts.search') }}">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" data-action="grow" placeholder="Search" aria-label="Search" name="search" autocomplete="off" required>
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="header_search">
        <button id="searchIcon"><i class="fa fa-search"></i></button>
        <div id="shide">
            <div id="search-hide">
                <form role="search" method="get" action="{{ route('posts.search') }}">
                    <input type="text" size="40" placeholder="Search here ..." name="search">
                </form>
                <button class="remove"><span><i class="fa fa-times"></i></span></button>
            </div>
        </div>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    @guest
            <li class="nav-item">
                <a style="margin: 5px 10px 0 0;" class="btn btn-danger btn-sm" href="{{ route('login') }}"><strong><span class="fa fa-edit"></span> Post</strong></a>
            </li>
            <li class="nav-item" style="margin-top: 5px;">
                <a class="btn btn-sm" href="{{ route('login') }}"><strong><span class="fa fa-sign-in"></span> Login</strong></a>
                <a class="btn btn-sm" href="{{ route('register') }}"><strong><span class="fa fa-pencil-square"></span> Register</strong></a>
            </li>
        </ul>
    </nav>
    @else
            <li class="nav-item">
                <a style="margin: 5px 10px 0 0;" class="btn btn-danger btn-sm" href="{{route('home.posts.create') }}"><strong><span class="fa fa-edit"></span> Post</strong></a>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <img src="/upload/users/{{Auth::user()->avata}}" class="img-circle elevation-2 img-fluid" alt="User Image" style="width: 30px !important; height: 30px !important; margin-top: -5px;">
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    @include('front.partials.box-hide')

@endguest
