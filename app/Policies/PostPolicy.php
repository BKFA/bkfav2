<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use App\Policies\Policy;

class PostPolicy
{

    /**
     * Grant all abilities to administrator.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->role === 1) {
            
            return true;
        }
    }

    /**
     * Determine whether the user can manage the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function manage(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
