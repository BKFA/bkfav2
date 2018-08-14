<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link brand-text font-weight-light">
        <img src="../library/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"style="opacity: .8">
        <span class="brand-text font-weight-light">TTB Blogs</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="/admin" class="nav-link active">
                        <i class="nav-icon fa fa-home"></i>
                        <p>{{ trans('sub.dashboard') }}</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('topics.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-bar-chart"></i>
                        <p>
                            {{ trans('sub.topics') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('tags.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>
                            {{ trans('sub.tags') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-file-text"></i>
                        <p>
                            {{ trans('sub.posts') }}
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>{{ trans('sub.list_posts') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('posts.create') }}" class="nav-link">
                                <i class="fa fa-plus-square nav-icon"></i>
                                <p>{{ trans('sub.add_post') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li ass="nav-item"><a class="nav-link"  href="{{ route('medias.index') }}"><i class="fa fa-image"></i> <span>@lang('Medias')</span></a></li>

                <li class="nav-header">{{ trans('sub.USERS') }}</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            {{ trans('sub.users') }}
                             <span class="right badge badge-danger"  style="margin-right: 10px;"><i class="fa fa-star"></i></span>   
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>{{ trans('sub.list_users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>{{ trans('sub.add_user') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="{{ route('comments.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-commenting"></i>
                        <p>
                            {{ trans('sub.comments') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="admin/contact/list" class="nav-link">
                        <i class="nav-icon fa fa-envelope-o"></i>
                        <p>
                            {{ trans('sub.contacts') }}
                        </p>
                    </a>
                </li>
                
                <li class="nav-header">{{ trans('sub.SYSTEM') }}</li>

                <li class="nav-item has-treeview">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-podcast"></i>
                        <p>
                            {{ trans('sub.adv') }}
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/adve/list" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>{{ trans('sub.list_adv') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/adve/add" class="nav-link">
                                <i class="fa fa-plus-square nav-icon"></i>
                                <p>{{ trans('sub.add_adv') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-picture-o"></i>
                        <p>
                            {{ trans('sub.images') }}
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>{{ trans('sub.list_img') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="fa fa-plus-square nav-icon"></i>
                                <p>{{ trans('sub.add_img') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
