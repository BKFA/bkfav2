<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\ {
    Http\Requests\AddPostRequest,
    Http\Requests\QuestionRequest,
    Http\Requests\SearchRequest,
    Http\Controllers\Controller,
    Repositories\PostRepository,
    Models\Tag,
    Models\Topic,
    Models\Post
};

class PostController extends Controller
{
    use Indexable;

    /**
     * The PostRepository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    //protected $postRepository;

    /**
     * The pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     * @return void
    */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'posts';
        $this->nbrPages = config('app.nbrPages.front.posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $posts = $this->repository->getAll($this->nbrPages);

    //     return view('front.pages.home', compact('posts'));
    // }

    /**
     * Display the detail post by slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        // dd($slug);
        $user = $request->user();

        return view('front.pages.detail', array_merge($this->repository->getPostBySlug($slug), compact('user')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all()->pluck('name_topic', 'id');
        $tags = Tag::all()->pluck('tag', 'id');

        return view('front.pages.write-post', ['topics'=>$topics, 'tags'=>$tags]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPostRequest $request)
    {
        $request->merge([
            'meta_des' => $request->title,
            'meta_keyword' => 'New Post, TTB Blogs',
            'seo_title' => $request->slug_title,
            'active' => 1,
        ]);
        $this->repository->store($request);

        return back()->with('message', __('The post has been successfully created'));
    }

    /**
     * Show the form for editing the post.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('manage', $post);
        $topics = Topic::all()->pluck('name_topic', 'id');
        $tags = Tag::all()->pluck('tag', 'id');

        return view('front.pages.edit', compact('post', 'topics', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('manage', $post);
        if($request->file('img') != null && !checkExtensionImage($request->file('img')->getClientOriginalExtension())){
             return back()->with('warning', __('Không hỗ trợ định dạng file này, bạn chọn fila là ảnh với đuôi là png, jpg, ....!'));
        }

        $request->merge([
            'meta_des' => $request->title,
            'meta_keyword' => 'New Post, TTB Blogs',
            'seo_title' => $request->slug_title,
        ]);
        $this->repository->update($post, $request);

        return back()->with('message', __('The post has been successfully updated'));
    }


    /**
     * Remove the specified post from storage.
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize('manage', $post);
        $post->delete();

        return back();
    }

    /**
     * Get posts for specified tag
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function tag(Tag $tag)
    {
        $posts = $this->repository->getActiveOrderByDateForTag($this->nbrPages, $tag->id);
        $info = __('Posts found with tag ') . '<strong>' . $tag->tag . '</strong>';

        return view('front.pages.list-post', compact('posts', 'info'));
    }

    /**
     * Display a listing of the posts for the specified topic.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function topic(Topic $topic)
    {
        $posts = $this->repository->getActiveOrderByDateForTopic($this->nbrPages, $topic->slug_topic);
        $info = __('Posts for Topic: ') . '<strong>' . $topic->name_topic . '</strong>';

        return view('front.pages.list-post', compact('posts', 'info'));
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function question(QuestionRequest $request, $type)
    {
        $request->merge([
            'type' => $type,
        ]);
        $this->repository->store($request);

        return back()->with('message', __('The post has been successfully created'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostByType($type)
    {
        $posts = $this->repository->getPostByType($type, $this->nbrPages);
        
        return [
            'html' => view('front/partials/home-list', compact('posts'))->render(),
        ];

    }

    /**
     * Get posts with search
     *
     * @param  \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $search = $request->search;
        $posts = $this->repository->search($this->nbrPages, $search)->appends(compact('search'));
        $info = __('Posts found with search: ') . '<strong>' . $search . '</strong>';

        return view('front.pages.search', compact('posts', 'info'));
    }

}
