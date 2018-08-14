<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Comment;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = null;

        if(isset($this->comment)) {
            $id = is_a($this->comment, Comment::class) ?  $this->comment->id :  $this->comment;
        }

        return [
            'message' . $id => 'bail|required|max:2000',
        ];
    }
}
