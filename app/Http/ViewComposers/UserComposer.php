<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('users', User::select('id', 'name', 'email', 'point', 'avata')->whereValid(true)->where('id', '!=',  Auth::id())->where('role', '!=', 1)->withCount('follows')->OrderBy('follows_count', 'desc')->get()->take(5) );
    }
}
