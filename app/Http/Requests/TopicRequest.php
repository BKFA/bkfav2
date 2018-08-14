<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
        return $rules = [
            'name_topic' => 'required|min:3|max:100|unique:topics,name_topic',
        ];
    }

    public function messages(){
        return [
            'name_topic.required' => __('Bạn chưa nhập topic'),
            'name_topic.min' => __('Topic phải có độ dài từ 3 đến 100 ký tự'),
            'name_topic.max' => __('Topic phải có độ dài từ 3 đến 100 ký tự'),
            'name_topic.unique' => __('Topic đã tồn tại'),
        ];
    }
}
