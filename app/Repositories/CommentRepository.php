<?php

namespace App\Repositories;

use App\Models\ {
    Comment,
    Post
};

class CommentRepository
{
    /**
     * Get next post comments.
     *
     * @param  \App\Models\Post  $post
     * @param  integer  $page
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNextComments(Post $post, $page)
    {
        return $post->parentComments()
            ->with('user')
            ->latest()
            ->skip($page * config('app.numberParentComments'))
            ->take(config('app.numberParentComments'))
            ->get();
    }
}
