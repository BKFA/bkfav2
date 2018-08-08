<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\ {
    Http\Controllers\Controller,
    Repositories\PostRepository,
    Repositories\UserRepository,
    Models\Tag,
    Models\Topic,
    Models\Post,
    Models\User
};

class UserController extends Controller
{
    /**
     * The PostRepository and user repository instance.
     *
     * @var \App\Repositories\PostRepository
     */
    protected $postRepository;
    protected $repository;

    /**
     * The pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new PostController instance.
     *
     * @param  \App\Repositories\PostRepository $postRepository
     * @return void
    */
    public function __construct(PostRepository $postRepository, UserRepository $repository)
    {
        $this->postRepository = $postRepository;
        $this->repository = $repository;
        $this->nbrPages = config('app.nbrPages.front.posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $users = $this->repository->getAll($this->nbrPages);

        return view('front.pages.list-user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('front.pages.profile', array_merge($this->postRepository->getPostByUser($user->id), compact('user')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return back()->with('message', __('Thay đổi thông tin cá nhân thành công.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update avata for user.
     *
     * @param  App\Modles\User
     * @return \Illuminate\Http\Response
     */
    public function avata(Request $request, User $user)
    {
        return $this->repository->avata($request, $user);
    }

    /**
     * Get posts with search
     *
     * @param  \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->key;
        if($search == '%20')
        {
            $users = $this->repository->getAll($this->nbrPages);
        }
        else
        {
            $users = User::select('id', 'name', 'email', 'point', 'avata', 'education')->whereValid(true)->where('role', '!=', 1)->Where('name', 'like', "%$search%")->orwhere('email', 'like', "%$search%")->withCount('follows')->OrderBy('follows_count', 'desc')->get();
        }

        return [
            'html' => view('front/partials/list-user', compact('users'))->render(),
        ];
    }

}
