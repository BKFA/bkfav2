<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'point', 
        'avata',
        'birthday', 
        'job', 
        'education', 
        'address', 
        'about', 
        'skill', 
        'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    /**
     * One to Many relation
     *
     * @return bool
     */
    public function isFollowing($followed_id)
    {
        return (bool)$this->follows()->where('followed_id', $followed_id)->first(['id']);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function countFollowing($user_id)
    {
        $count = DB::select('SELECT COUNT(user_id) AS count FROM `follows` WHERE followed_id = ' .$user_id);

        return $count;
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    /**
     * One to Many relation
     *
     * @return bool
     */
    public function isRating($post_id)
    {
        return (bool)$this->rates()->where('post_id', $post_id)->first(['id']);
    }

    /**
     * Get user files directory
     *
     * @return string|null
     */
    public function getFilesDirectory()
    {
        if ($this->role === 0) {
            $folderPath = 'user' . $this->id;
            if (!in_array($folderPath , Storage::disk('files')->directories())) {
                Storage::disk('files')->makeDirectory($folderPath);
            }
            return $folderPath;
        }
        return null;
    }

}
