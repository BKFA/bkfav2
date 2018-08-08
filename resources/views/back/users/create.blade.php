<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Topic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    {!! Form::open(['method' => 'POST', 'route' => 'topics.store']) !!}
                         <div class="form-group row">
                            {!! Form::label('txtTopic', 'Add: ', ['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('name_topic', null, ['id' => 'txtTopic', 'class' => 'form-control', 'placeholder' => 'Enter Topic']) !!}
                                </div>
                        </div>
                         <div class="modal-footer">
                            {!! Form::reset('Refresh', ['class'=>'btn btn-outline-secondary btn-sm']) !!}
                            {!!  Form::submit('Create', ['class'=>'btn btn-outline-primary btn-sm']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>