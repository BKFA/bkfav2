<div class="col-md-12">
    <!-- Box Comment -->
    <div class="card-widget">
        <div class="card-header">
            <div class="user-block">
                @if (Auth::check())
                    <img class="img-circle" src="/upload/users/{{Auth::user()->avata}}" alt="User Image">
                    <span class="username"> <a href="{{ route('login') }}" data-toggle="modal" data-target="#questionModal"><span class="description add-question"><strong> What is your question?</strong></span></a></span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    <!-- The Modal -->
                    <div class="modal fade" id="questionModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-info card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fa fa-paper-plane"></i>
                                                    <small>Thank for send your question !!!</small>
                                                 </h3>
                                                <!-- tools box -->
                                                <div class="card-tools">
                                                    <button class="btn btn-tool btn-sm" type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- /. tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="z-index: 3;">
                                                <form action="{{ route('posts.questions', [0]) }}" method="post">
                                                    {{ csrf_field() }}
                                                     <div class="form-group">
                                                        <input type="checkbox" value="1" name="active" checked>
                                                        {!! Form::label( 'Title: ') !!}
                                                        {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Question ?']) !!}
                                                    </div>
                                                    <div class="form-group hide">
                                                        {!! Form::label( 'Slug: ') !!}
                                                        {!! Form::text('slug_title', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Slug ...']) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tags"> Select Tag: </label>
                                                        <select class="form-control tags" multiple="multiple" data-placeholder="Select a Enter Tag" style="width: 100%;" name="tag_id[]">
                                                            @foreach ($tags as $tag)
                                                                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        {!! Form::label( 'Description: ') !!}
                                                        {!! Form::textarea('description', null, ['class'=>'form-control', 'rows' => 5, 'cols' => 40, 'placeholder' => 'Description question ..']) !!}
                                                    </div>
                                                    <p class="text-sm mb-0"><span class="fa fa-hand-o-right"></span><b> How to quickly get a good answer:</b>
                                                        <i>Keep your question short and to the point. Check for grammar or spelling errors.Phrase it like a question</i></p><br>
                                                    {!!  Form::submit('Create', ['class'=>'btn btn-outline-primary btn-sm float-right']) !!}
                                                    {!! Form::reset('Refresh', ['class'=>'btn btn-outline-secondary btn-sm float-right kc']) !!}
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- ./row -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    @else
            <img class="img-circle" src="https://d30y9cdsu7xlg0.cloudfront.net/png/88093-200.png" alt="User Image">
                <span class="username"> <a href="{{ route('login') }}"><span class="description add-question"><strong> What is your question?</strong></span></a></span>
            </div>
        </div>
        <!-- /.card-header -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endif

@section('js')
<!-- Validate Image -->
<script src="{{asset('js/blog.js')}}"></script>

<script>
    $(document).ready(function(){
        $(".tags").select2({
            tags: true
        });
        
    });

    $('#slug').keyup(function () {
        $(this).val(v.slugify($(this).val()))
    })

    $('#title').keyup(function () {
        $('#slug').val(v.slugify($(this).val()))
    })

</script>
@endsection
                
           
        