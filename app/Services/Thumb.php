<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class Thumb
{
    /**
     * Make thumb image path
     *
     * @param $img
     * @return void
     */
    public static function makeThumbPath($img, $str)
    {
        $url = substr(time() . mt_rand() . '_' . $img->getClientOriginalName(), -190); 
        while (file_exists(getUrlFileUpload($img->getClientOriginalExtension(), $str). $url)) {
            $url = substr(time() . mt_rand() . '_' . $img->getClientOriginalName(), -190);
        }
        $img->move(getUrlFileUpload($img->getClientOriginalExtension(), $str), $url);

        return $url;
    }

}
