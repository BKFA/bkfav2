<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        return [
            'tag' => 'required|min:3|max:100|unique:tags,tag',
        ];
    }

    public function messages(){
        return [
            'tag.required' => __('Bạn chưa nhập topic'),
            'tag.min' => __('Topic phải có độ dài từ 3 đến 100 ký tự'),
            'tag.max' => __('Topic phải có độ dài từ 3 đến 100 ký tự'),
            'tag.unique' => __('Topic đã tồn tại'),
        ];
    }
}
