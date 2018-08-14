<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@lang('Administration')</title>

        <base href="{{asset('')}}" >
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('library/plugins/font-awesome/css/font-awesome.min.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('library/plugins/datatables/dataTables.bootstrap4.css') }}">
        <!-- Select2 (Select many option) -->
        <link rel="stylesheet" href="{{ asset('library/plugins/select2/select2.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="{{ asset('fonts/index.css') }}" rel="stylesheet">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('library/dist/css/adminlte.min.css') }}">
        <!-- Google Font-->
        <link  rel="stylesheet" href="{{ asset('fonts/Eczar.css') }}">
        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

        @yield('css')

    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            @include('back.header')

            @include('back.menu')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @yield('content')

                <div class="overlay"></div>
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            @include('back.footer')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('library/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('library/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
         <!-- DataTables -->
        <script src="{{ asset('library/plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('library/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('library/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('library/plugins/select2/select2.full.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('library/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('library/dist/js/adminlte.min.js') }}"></script>
        <!-- Slug text -->
        <script src="{{ asset('library/plugins/voca/voca.min.js') }}"></script>
        <!-- Editor -->
        <script src="{{asset('ckeditor/ckeditor.js') }}"></script>
        <!-- My js -->
        <script src="{{asset('js/ajax-loading.js')}}"></script>

        @yield('js')

    </body>
</html>
