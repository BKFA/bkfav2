<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

use App\ {
    Http\Requests\PostRequest,
    Http\Controllers\Controller,
    Models\Topic,
    Models\Post,
    Models\User,
    Models\Tag,
    Repositories\PostRepository
};

use DB;
use Auth;
use Response;

class PostController extends Controller
{

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'posts';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::oldest('updated_at')->get();

        return view('back.posts.index', compact ('posts'));
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

        return view('back.posts.create', ['topics'=>$topics, 'tags'=>$tags]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
         if ($request->file('img') != null && !checkExtensionImage($request->file('img')->getClientOriginalExtension())) {

            return back()->with('warning', __('Không hỗ trợ định dạng file này, bạn chọn fila là ảnh với đuôi là png, jpg, ....!'));
        }
        $this->repository->store($request);

        return redirect(route('posts.index'))->with('message', __('The post has been successfully created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('back.posts.edit', compact('post', 'topics', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('manage', $post);
        $ext = $request->file('img')->getClientOriginalExtension();
        if (!checkExtensionImage($ext)) {

            return back()->with('warning', __('Không hỗ trợ định dạng file này!'));
        }else{
            $this->repository->update($post, $request);

            return back()->with('message', __('The post has been successfully updated'));
        }
    }

    /**
     * Remove the post from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('manage', $post);
        $post->delete ();

        return redirect(route('posts.index'))->with('message', __('The tag has been successfully delete'));
    }

    /**
     * Update "active" field for post.
     *
     * @param  \App\Models\Post $post
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Post $post, $status)
    {
        $post->active = $status;
        $post->save();

        return response ()->json(auth()->id());
    }

}
