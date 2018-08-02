<style>
    #sidebar-overlay{
        z-index: 1;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-1 sidebar-light-primary" style="margin-top: 60px; z-index: 2;">
    <a href="index3.html" class="brand-link">
        <img src="../library/dist/img/w.png" alt="WokShop Logo" class="brand-image img-circle elevation-1" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>TTB Books.<span class="right badge badge-info" style="margin-left: 15px;"><i class="fa fa-signal"></i></span></b></span>
    </a>
    <!-- Sidebar -->
    <div class="menu-right">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                @foreach ($topics as $topic)
                    <li class="nav-item">
                        <a href="{{ route('topic', [$topic->slug_topic ]) }}" class="nav-link">
                          <i class="nav-icon fa fa-pie-chart"></i>
                          <p>{{ $topic->name_topic }}</p>
                        </a>
                    </li>
                @endforeach
                <li class="nav-header"><b>Work Shop</b></li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-pie-chart"></i>
                      <p>
                        Git
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../charts/chartjs.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Key Word</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../charts/flot.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Git Base</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../charts/inline.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Git Master</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tree"></i>
                            <p>OOP<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../UI/general.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Key Word</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/icons.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Basic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/buttons.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Master</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/sliders.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Other</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-edit"></i>
                      <p>
                        MySQL
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../forms/general.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Key Word</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../forms/advanced.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Basic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../forms/editors.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Master</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-table"></i>
                      <p>
                        JavaScript
                        <i class="fa fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../tables/simple.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Documents</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../tables/data.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Tutorial</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header"><b>Framework</b></li>
                <li class="nav-item  has-treeview">
                    <a href="../widgets.html" class="nav-link">
                      <i class="nav-icon fa fa-th"></i>
                      <p>
                        NodeJs
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../mailbox/mailbox.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Key Word</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/compose.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Basic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/read-mail.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Tutorial</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-envelope-o"></i>
                        <p>Laravel<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../mailbox/mailbox.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Key Word</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/compose.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Basic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/read-mail.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Master</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-file-o"></i>
                        <p>VueJS
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../examples/invoice.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Basic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/profile.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Documents</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/login.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Master</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header"><b>Other</b></li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs" class="nav-link">
                      <i class="nav-icon fa fa-file"></i>
                      <p>Life Coder</p>
                    </a>
                </li>
            </ul>
            <br><br><br><br><br><br>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>