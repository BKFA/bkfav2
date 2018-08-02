<?php

namespace App\Repositories;

use App\Models\ {
	Post,
    Tag,
    Comment,
    Topic,
    User
};
use App\Services\Thumb;

class PostRepository
{
    /**
     * The Tag instance.
     *
     * @var \App\Models\Tag
     */
    protected $tag;

    /**
     * The Comment instance.
     *
     * @var \App\Models\Comment
     */
    protected $comment;

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
     * @param  \App\Models\Post $post
     * @param  \App\Models\Tag $tag
     * @param  \App\Models\Comment $comment
     */
    public function __construct(Post $post, Tag $tag, Comment $comment, Thumb $thumb)
    {
        $this->model = $post;
        $this->tag = $tag;
        $this->comment = $comment;
        $this->thumb = $thumb;
    }

    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActiveOrderByDate()
    {
        return $this->model
            ->select('id', 'user_id', 'title', 'slug_title', 'description', 'content_post', 'url_img', 'updated_at', 'rate')
            ->whereActive(true)
            ->withCount('validComments')
            ->withCount('parentComments')
            ->latest();
    }

    /**
     * Get active posts.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDate()
    {
        return $this->queryActiveOrderByDate()->paginate(10);
    }

    /**
     * Get active posts for specified tag.
     *
     * @param  int  $nbrPages
     * @param  int  $tag_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForTag($nbrPages, $tag_id)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('tags.id', $tag_id);
            })->with(['parentComments' => function ($q) {
                $q->with('user')
                    ->latest()
                    ->get();
            }])
            ->withCount('validComments')
            ->withCount('parentComments')->paginate($nbrPages);
    }

    /**
     * Get active posts for specified topic.
     *
     * @param  int  $nbrPages
     * @param  string  $category_slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForTopic($nbrPages, $topic_slug)
    {
        return $this->queryActiveOrderByDate()
        ->whereHas('topic', function ($q) use ($topic_slug) {
            $q->where('topics.slug_topic', $topic_slug);
        })->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->get();
        }])
        ->withCount('validComments')
        ->withCount('parentComments')->paginate($nbrPages);
    }

    /**
     * Get posts with comments page home.
      *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getPost($nbrPages)
    {
        // Post with user, tags and topics
        $posts = $this->model->with([
            'user' => function ($q) {
                $q->select('id', 'name', 'email', 'avata');
            },
            'tags' => function ($q) {
                $q->select('tags.id', 'tag');
            },
            'topic' => function ($q) {
                $q->select('id', 'name_topic', 'slug_topic');
            },
        ])
        ->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->get();
        }])
        ->withCount('validComments')
        ->withCount('parentComments')
        ->whereActive(true)
        ->latest()
        ->paginate($nbrPages);
        
        return $posts;
    }

    /**
     * Get post by slug.
     *
     * @param  string  $slug
     * @return array
     */
    public function getPostBySlug($slug)
    {
        // Post for slug with user, tags and topics
        $post = $this->model->with([
            'user' => function ($q) {
                $q->select('id', 'name', 'email', 'avata');
            },
            'tags' => function ($q) {
                $q->select('tags.id', 'tag');
            },
            'topic' => function ($q) {
                $q->select('name_topic', 'slug_topic');
            }
        ])
        ->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->take(config('app.numberParentComments'));
        }])
        ->withCount('validComments')
        ->withCount('parentComments')
        ->whereSlugTitle($slug)
        ->firstOrFail();

        // Previous post
        $post->previous = $this->getPreviousPost($post->id);

        // Next post
        $post->next = $this->getNextPost($post->id);

        $post->related = $this->getRelated($post->topic_id, $post->id);

        return compact('post');
    }

    /**
     * Get related post
     *
     * @param  integer  $topic_id, $id
     * @return \Illuminate\Database\Eloquent\Collection
     */

    protected function getRelated($topic_id, $id)
    {
        return $this->model->select('title', 'slug_title', 'rate')->where('id', '!=', $id)->where('topic_id', $topic_id)->orderBy('rate', 'desc')->get();
    }

    /**
     * Get previous post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPreviousPost($id)
    {
        return $this->model->select('title', 'slug_title')->where('id', '<', $id)->latest('id')->first();
    }

    /**
     * Get next post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getNextPost($id)
    {
        return $this->model->select('title', 'slug_title')->where('id', '>', $id)->oldest('id')->first();
    }

    /**
     * Get posts by type
      *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getPostByType($type, $nbrPages)
    {
        // Post with user, tags and topics
        $posts = $this->model->with([
            'user' => function ($q) {
                $q->select('id', 'name', 'email', 'avata');
            },
            'tags' => function ($q) {
                $q->select('tags.id', 'tag');
            },
            'topic' => function ($q) {
                $q->select('id', 'name_topic', 'slug_topic');
            },
        ])
        ->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->get();
        }])
        ->withCount('validComments')
        ->withCount('parentComments')
        ->whereActive(true)
        ->where('type', $type)
        ->orderBy('rate', 'desc')
        ->paginate($nbrPages);
        
        return $posts;
    }

    /**
     * Get post by slug.
     *
     * @param  string  $slug
     * @return array
     */
    public function getPostByUser($user_id)
    {
        // Post for slug with user, tags and categories
        $posts = $this->model->with([
            'user' => function ($q) {
                $q->withCount('follows');
            },
            'tags' => function ($q) {
                $q->select('tags.id', 'tag');
            },
            'topic' => function ($q) {
                $q->select('name_topic', 'slug_topic');
            }
        ])
        ->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->take(config('app.numberParentComments'));
        }])
        ->withCount('validComments')
        ->withCount('parentComments')
        ->where('user_id', $user_id)
        ->get();

        // Previous post
        // Next post

        return compact('posts');
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function store($request)
    {
        if($request->file('img') != null){
            $url = $this->thumb->makeThumbPath($request->file('img'), 'posts');
        }else $url = null;
    	
        $request->merge([
            'user_id' => auth()->id(),
            'active' => $request->has('active'),
            'url_img' => $url,
        ]);
        $post = Post::create($request->all());
        $user = User::find(auth()->id());
        $user->point += 1;
        $user->save();
        $this->saveTags($post, $request);
    }

    /**
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($post, $request)
    {
        if($request->file('img') != null){
            $url = $this->thumb->makeThumbPath($request->file('img'), 'posts');
            if ( $post->url_img != null && file_exists('upload/posts/' . $post->url_img)) unlink('upload/posts/' . $post->url_img);
            $request->merge(['url_img' => $url]);
        }
        
        $request->merge(['active' => $request->has('active')]);
        $post->update($request->all());

        $this->saveTags($post, $request);
    }

    /**
     * Save tags.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    protected function saveTags($post, $request){
        $tags_id = $request->tag_id;
       
        if ($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $tag_ref = Tag::firstOrCreate(['tag' => $tag, 'slug_tag' => changeTitle($tag)]);
                $tags_id[] = $tag_ref->id;
            }
        }

        $post->tags()->sync($tags_id);
    }

    /**
     * Get posts with search.
     *
     * @param  int  $n
     * @param  string  $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    // public function search($n, $search)
    // {
    //     $posts = $this->queryActiveOrderByDate()
    //     ->where(function ($q) use ($search) {
    //         $q->where('title', 'like', "%$search%")
    //             ->orwhere('slug_title', 'like', "%$search%")
    //             ->orWhere('description', 'like', "%$search%")
    //             ->orWhere('content_post', 'like', "%$search%");
    //     })->paginate($n);

    //     $posts->tags = Tag::select('tags.id', 'tag')->where('tag', 'like', "%$search%")->get();

    //     return $posts;
    // }

    public function search($n, $search)
    {
        $posts = $this->queryActiveOrderByDate()
        ->where(function ($q) use ($search) {
            $q->search($search);
        })->paginate($n);

        $posts->tags = Tag::select('tags.id', 'tag')->where('tag', 'like', "%$search%")->get();
        
        return $posts;
    }

}
