@foreach($posts as $post)
    <tr class="pannel" data-boardid="{{ $post->id }}">
        <td>@if($post->topic_id != null){{$post->topic->name_topic}}@endif</td>
        <td><p data-toggle="tooltip" title="{{$post->title}}">{{cutString($post->title, 20)}}</p>
        </td>
        <td>
            <style>
                img {
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    padding: 5px;
                    width: 150px;
                }

                img:hover {
                    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
                }
            </style>
            @if($post->url_img == null)
                <a target="_blank" href="/upload/default.png" class="row justify-content-center align-items-center">
                    <img src="/upload/default.png" alt="Forest" style="width:50px">
                </a>
            @else
                <a target="_blank" href="/upload/posts/{{$post->url_img}}">
                    <img src="/upload/posts/{{$post->url_img}}" alt="Forest" style="width:100px">
                </a>
            @endif
            
        </td>
        <td>{{$post->user->name}}</td>
        <td>
            {{ csrf_field() }}
            <input type="checkbox" id="active" name="status" value="{{ $post->id }}" {{ $post->active ? 'checked' : ''}}>
            <br>
            <span style="font-size: 12px;">View: <code>{{$post->view}}</code></span>
        </td>
        <td>
            @foreach ($post->tags as $tag)
               <a href="" type="button" class="btn btn-outline-secondary btn-sm" style="padding: 1px; margin: 3px;">{{$tag->tag}}</a>
            @endforeach
        </td>
        <td>
            <p data-toggle="tooltip" title="{{$post->seo_title}}">{{cutString($post->seo_title, 20)}}
            </p>
        </td>
        <td>
            <div class="mrg-top-15">
                <div class="row justify-content-center align-items-center">
                    <button type="button" class="btn btn-outline-info btn-sm" style="float: right;" data-toggle="modal" data-target="#contentModal{{$post->id}}"><i class="fa fa-eye" ></i></button>
                </div>
                <div class="modal fade" id="contentModal{{$post->id}}" tabindex="-1" role="text" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 10000">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ trans('sub.detail') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <style>
                                .model-title{
                                    color: blue;
                                }
                            </style>
                            <div class="modal-body">
                                <div class="container">
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.ID') }}: </h5>
                                            {{$post->id}}
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.topic') }}</h5>
                                            @if($post->topic_id != null){{$post->topic->name_topic}}@endif
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.author') }}</h5>
                                            {{$post->user->name}}
                                        <hr>
                                    </div>
                                     <div>
                                        <h5 class="model-title">{{ trans('sub.description') }}</h5>
                                            {{$post->description}}
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.tags') }}</h5>
                                        @foreach ($post->tags as $tag)
                                           <a href="#" type="button" class="btn btn-outline-secondary btn-sm" style="padding: 1px;">{{$tag->tag}}</a>
                                        @endforeach
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.images') }}</h5>
                                        @if($post->url_img == null)
                                                <img src="/upload/default.png" alt="Forest">
                                        @else
                                                <img src="/upload/posts/{{$post->url_img}}" alt="Forest">
                                        @endif
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.content') }}</h5>
                                        @php  
                                            echo $post->content_post
                                        @endphp
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.seo_title') }}</h5>
                                        {{$post->seo_title}}
                                        <hr>
                                    </div>
                                     <div>
                                        <h5 class="model-title">{{ trans('sub.meta_des') }}</h5>
                                        {{$post->meta_des}}
                                        <hr>
                                    </div>
                                    <div>
                                        <h5 class="model-title">{{ trans('sub.meta_key') }}</h5>
                                        {{$post->meta_keyword}}
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </td>
        <td>
            <div class="m-sm-auto">
                <a href="{{ route('posts.edit', [$post->id]) }}" title="Update">
                    <button type="button" class="btn btn-warning btn-sm"><span class="fa fa-edit"></span>   
                    </button>
                </a>
            </div>
        </td>            
        <td>
            <div class="m-sm-auto">
                <button type="button" title="Delete" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delModal{{$post->id}}"> <span class="fa fa-trash"></span>  
                </button>
                @include('back.posts.delete')
            </div>
        </td>
    </tr>
@endforeach