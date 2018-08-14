<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Rate;
use App\Models\User;
use App\Models\Post;

class RateController extends Controller
{
    //
    public function rate(Post $post)
    {
        if (!Auth::user()->isRating($post->id)) {
            // Create a new follow instance for the authenticated user
            Auth::user()->rates()->create([
                'post_id' => $post->id,
            ]);
            $post->rate += 1;
        	$post->save();
        // } else {
        // 	$rate = Auth::user()->rates()->where('post_id', $post->id)->first();
        //     $rate->delete();
        //     $post->rate -= 1;
        // 	$post->save();
        }

        return response ()->json($post->rate);
    }

}
