<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\Thumb;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
	/**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Upload instance.
     *
     * @var App\Services\Thumb
     */
    protected $thumb;

    /**
     * Create a new BlogRepository instance.
     *
     * @param  \App\Models\User $user
     */
    public function __construct(User $user, Thumb $thumb)
    {
        $this->model = $user;
        $this->thumb = $thumb;
    }

    /**
     * Update avata for user.
     *
     * @param  App\Modles\User
     * @return \Illuminate\Http\Response
     */
    public function avata($request, $user)
    {
        if($request->file('file') != null && checkExtensionImage($request->file('file')->getClientOriginalExtension())){
            $url = $this->thumb->makeThumbPath($request->file('file'), 'users');
            if ( $user->avata != 'avata.png' && file_exists('upload/users/' . $user->avata)) unlink('upload/users/' . $user->avata);
        }else{
            $url = 'avata.png';
        }
        $user->avata = $url;
        $user->save();

        return response ()->json($user->avata);
    }

    /**
     * Get users collection paginate.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages)
    {
        $users =  User::select('id', 'name', 'email', 'point', 'avata', 'education')->whereValid(true)->where('id', '!=',  Auth::id())->where('role', '!=', 1)->withCount('follows')->OrderBy('follows_count', 'desc')->paginate($nbrPages);
        $users->count = User::whereValid(true)->where('role', '!=', 1)->count();

        return $users;
    }

}
