<div class="">
    <div class="card-header">
        <h3 class="card-title">Related Posts</h3>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <div class="clear"></div>
            @foreach($posts as $post)
                <li class="nav-item">
                    @if($post->rate > 10)
                        <span class="badge bg-warning float-left"> {{ $post->rate }}</span>
                    @else
                        <span class="badge bg-primary float-left"> {{ $post->rate }}</span>
                    @endif
                    <a href="{{ url('posts/' . $post->slug_title) }}" style="margin-left: 7px;"> {{ $post->title }} </a>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- /.card-body -->
</div>
<!-- /. box -->