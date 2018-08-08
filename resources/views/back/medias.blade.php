@extends('back.index') 

@section('title')
	{{ trans('sub.medias') }}
@endsection

@section('content')
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{!! route('elfinder.index') !!}"></iframe>
    </div>
@endsection
