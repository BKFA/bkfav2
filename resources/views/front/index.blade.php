<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('Q&A')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ asset('') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('library/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Select2 (Select many option) -->
    <link rel="stylesheet" href="{{ asset('library/plugins/select2/select2.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('fonts/index.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('library/dist/css/adminlte.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

    @yield('css')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('front.header')

        @include('front.menu')
        
        @yield('content')

        @include('front.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('library/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('library/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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

    @if (auth()->check())
        <script>
            //change avavta
            var addNewLogo = function(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        //Hiển thị ảnh vừa mới upload lên
                        $('#logo-img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                    //submit form để upload ảnh
                    $('#img-upload-form').submit();
                }
            }

            var submitImageForm = function(form, id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: 'front/user/avata/' + id,
                    type: "POST",
                    data: new FormData($('#img-upload-form')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                        setTimeout(function(){ 
                            window.location.href = window.location.href;
                        }, 1000);
                        console.log('thanh cong');
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('error');
                        console.log(data);
                    }
                });
                return false;
            }
            // end

            // action of comment
            var post = (function () {
                //edit comment
                var enter = function (id) {
                    $('#form-edit' + id).keypress(function(event){
                        var keycode = (event.keyCode ? event.keyCode : event.which);
                            if (keycode == '13') {
                                var text = $('#form-edit'+id).val();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                                });
                                $.ajax({
                                    url: 'front/comment/update/' + id,
                                    type: 'PUT',
                                    dataType: 'json',
                                    data: {
                                        '_token': $('input[name=_token]').val(),
                                        'id': id,
                                        'content_cmt': text
                                    },
                                    success: function (data) {
                                        //window.location.href = window.location.href;
                                        $('#cmt_content' + data.id).html(data.content_cmt);
                                        console.log('ok');
                                        console.log(data);
                                    },
                                    error: function (error) {
                                        console.log('error');
                                        console.log(error); 
                                    }
                                });
                            }
                    });
                }

                var onReady = function () {
                    $('body').on('click', 'a.deletecomment', deleteComment)
                        .on('click', 'a.editcomment', editComment)
                }

                // Delete comment
                var deleteComment = function (event) {
                    event.preventDefault()
                    $(this).next('form').submit()
                }

                // Set comment edition
                var editComment = function (event) {
                    event.preventDefault()
                    var i = $(this).attr('id').substring(12);
                    var content = $('#cmt_content'+i).text();
                    $('#cmt_content' + i).html("<input type='text' class='form-control form-control-sm' placeholder='Press enter to post comment' value='"+ content +"'  required id='form-edit" + i + "'> "
                    )
                    enter(i)
                }
                return {
                    onReady: onReady
                }

            })()

            $(document).ready(post.onReady)

            //submit comment
            function submitComment(id){
                $('#comment' + id).keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                        if (keycode == '13') {
                            var text = $('#comment'+id).val();
                            if(text != 0){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                                });
                                $.ajax({
                                    url: 'front/comment/submit',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        '_token': $('input[name=_token]').val(),
                                        'id': id,
                                        'content_cmt': text
                                    },
                                    success: function (data) {
                                        $('.form-comment' + id).append(data.html)
                                        $('#comment'+id).val('');
                                        console.log('ok');
                                        console.log(data);
                                    },
                                    error: function (error) {
                                        console.log('error');
                                        console.log(error); 
                                    }
                                });
                                
                            }else{
                                $('#comment'+id).val('');
                            }
                           
                        }
                });
            }

             //submit childen comment
            function submitChildComment(id){
                $('#child-comment' + id).keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                        if (keycode == '13') {
                            var text = $('#child-comment'+id).val();
                            if(text != 0){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                                });
                                $.ajax({
                                    url: 'front/comment/child/submit/' + id,
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        '_token': $('input[name=_token]').val(),
                                        'parent_id': id,
                                        'content_cmt': text
                                    },
                                    success: function (data) {
                                        $('.list-child' + id).append(data.html)
                                        $('#child-comment'+id).val('');
                                        console.log('ok');
                                        console.log(data);
                                    },
                                    error: function (error) {
                                        console.log('error');
                                        console.log(error); 
                                    }
                                });
                                
                            }else{
                                $('#child-comment'+id).val('');
                            }
                           
                        }
                });
            }

            // end

        </script>
    @endif

</body>

</html>