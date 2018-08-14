@extends('front.index') 

@section('title')
    {{ trans('sub.contact') }}
@endsection 

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 800px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compose</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
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
                <!-- /.col -->
                <div class="col-md-9">
                    <h1 class="entry-title add-bottom">@lang('Liên hệ với chúng tôi')</h1>

                    <p class="lead">@lang('TTB Blogs hoan nghênh các ý kiến, câu hỏi và phản hồi của bạn. Xin vui lòng tìm thông tin đầy đủ của chúng tôi dưới đây. Chúng tôi cũng luôn sẵn sàng trả lời tất cả câu hỏi liên quan đến các chi phí trên sao kê tài khoản hoặc sao kê thẻ tín dụng của bạn. Chúng tôi thường trả lời trong vòng 24 giờ trong các ngày làm việc..')</p>
                    <div class="col-sm-12">
                        @if(count($errors) > 0)
                            <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #EE7C60 !important; font-size: 14px; margin-top: 10px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>
                                    @foreach($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach()
                                </strong>
                            </div>
                        @endif
                        @if(session('message'))
                            <div class="p-3 mb-3 rounded alert rounded box-shadow" style="background: #7DF5B4 !important; font-size: 14px; margin-top: 10px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{session('message')}}</strong>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('home.contact.store') }}">
                        {{ csrf_field() }}
                        <div class=" card-outline">
                            <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Enter Full Name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Enter Email Address" name="email">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" style="height: 300px" name="message"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="">
                                    <div class="float-right">
                                       <button type="reset" class="btn btn-secondary" onClick="window.location.reload()">Reset <i class="fa fa-refresh"></i></button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                                    </div>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /. box -->
                        </form>
                    </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="col-six tab-full">
                        <h4>@lang('Địa chỉ Liện hệ')</h4>
                        <p>@lang('Số 1 Đại Cồ Việt, Đại học Bách Khoa Hà Nội.')</p>
                    </div>
                    <div class="col-six tab-full">
                        <h4>@lang('Thông tin liên hệ')</h4>
                        <p>@lang('tranbinhbak@gmail.com.com<br>info@website.com<br>Phone: (+84) 123 456 789')</p>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection