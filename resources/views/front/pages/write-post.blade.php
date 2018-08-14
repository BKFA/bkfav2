<html>

<head>
    <link rel="stylesheet" href="{{ asset('library/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('library/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Select2 (Select many option) -->
    <link rel="stylesheet" href="{{ asset('library/plugins/select2/select2.min.css') }}">
    <title>Write Post for TTB Blogs</title>
    <style>
    body {
        position: relative;
    }

    #cke_body {
        border: none;
        width: 80%;
        margin: 0 auto;
    }

    #cke_1_top {
        border: 1px solid #dedede;
        position: absolute;
        top: 55px;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 3px 3px 3px #B0B0B0;
        -moz-box-shadow: 3px 3px 3px #B0B0B0;
        -webkit-box-shadow: 3px 3px 3px #B0B0B0;
    }

    .autor-biografia {
        background-color: #EBF0FF;
    }

    #title{
        border: none;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="/">TTB Blogs</a>
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Option
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </li>
        </ul>
    </nav>
    <br>
    <br>
    <br>
    <div class="container-fluid">
        <div class="autor-biografia text-center">
            <form id="img-upload-form" method="post" accept-charset="utf-8" onsubmit="return submitImageForm(this)" style="width: 100%;">
                <a href="script::void(0)">
                   <img id="logo-img" class="img-fluid" onclick="document.getElementById('add-new-logo').click();" src="https://static.licdn.com/sc/h/9ibqs2274myrjuc051lgyyy0o" />
                   <input type="file" style="display: none;" id="add-new-logo" name="file" accept="image/*" onchange="addNewLogo(this)"/>
                <a>
            </form>
        </div>
        <br><hr><br>
        <div class="row" style="width: 80%; margin: 0 auto;">
            <div class="col-md-4">
                 {!! Form::select('topic_id', $topics, null, ['class' => 'form-control select2', 'placeholder' => 'Select Topic']) !!}
            </div>
            <div class="col-md-4">
                {!! Form::select('tag_id[]', $tags, null, ['multiple' => true, 'id' => 'tags', 'class' => 'form-control tags', 'data-placeholder' => 'Select a Enter Tag']) !!}
            </div>
            <div class="col-md-4">
                {!! Form::text('tags', null, ['id' => 'tags', 'class' => 'form-control', 'placeholder' => 'Please enter Tag of you']) !!}
            </div>
        </div>
        <div class="row">
            <textarea class="form-control" id="title" rows="1" placeholder="HeadLine" style="margin:30px auto; width: 80%; font-size: 30px; font-weight: bold; margin-bottom: 20px;"></textarea>
            <textarea class="form-control" rows="10" id="body" name="body" placeholder="HeadLine">
                <h3 style="color:#aaaaaa;font-style:italic;">Enter text</h3>
            </textarea>
        </div>
    </div>
    <div class="footer text-center" style="padding: 20px;">
        <strong>Copyright © 2018 - TTB Blogs</strong>
    </div>
     <!-- jQuery -->
    <script src="{{ asset('library/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('library/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('library/plugins/select2/select2.full.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('body', { customConfig: '/js/ckeditor.js' })

    $(document).ready(function(){
        $(".tags").select2({
            tags: true
        });
        
    });

    var addNewLogo = function(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                //Hiển thị ảnh vừa mới upload lên
                $('#logo-img').attr('src', e.target.result);
                $('#logo-img').attr('width', '600px');
            }
            reader.readAsDataURL(input.files[0]);
            //submit form để upload ảnh
            $('#img-upload-form').submit();
        }
    }

    </script>
</body>

</html>