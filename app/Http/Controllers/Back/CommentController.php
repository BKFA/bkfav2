<?php

namespace App\Http\Controllers\Back;

use App\ {
    Models\Comment,
    Repositories\CommentRepository,
    Http\Controllers\Controller
};

class CommentController extends Controller
{
    /**
     * Create a new CommentController instance.
     *
     * @param  \App\Repositories\CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;

        $this->table = 'comments';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::oldest('id')->get();

        return view('back.comments.index', compact ('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete ();

        return redirect(route('comments.index'))->with('message', __('The comment has been successfully delete'));
    }
}
