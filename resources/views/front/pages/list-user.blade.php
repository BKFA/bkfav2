@extends( 'front.index') 

@section( 'title') 
    {{ trans( 'sub.list-user') }} 
@endsection 

@section( 'content') 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Users</li>
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
                <div class="col-md-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <span style="margin-left: 10px;"> {{ $users->count }} Users</span>
                            <div class="float-left">
                                <div class="btn-group">
                                    {{ $users->links() }}
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.float-right -->
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search User" id="search-user">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="min-height: 500px;">
                            <div class="mailbox-controls">
                            </div>
                            <div class="row" style="margin-left: 30px;" id="list-user">
                                @include('front.partials.list-user')
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection

@section('js')

<script>
$(document).ready(function(){
    $("#search-user").keyup(function(){
           var str=  encodeURI($("#search-user").val());
        if(str == "") {
            $( "#list-user" ).html("<b>Blogs information will be listed here...</b>");
            window.location.href = window.location.href;
        }else {
            $.ajax({
                url: 'users/search/' + str,
                method: 'GET',
                success: function (data)
                {
                    console.log('thanh cong');
                    console.log(data);
                    $('#list-user').html(data.html);
                },
                error: function (data) {
                    console.log('error');
                    console.log(data);
                }
            });
        }
    });  
}); 
</script>

@stop