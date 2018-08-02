<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'title' => 'required|min:20|unique:posts,title',
        ];
    }

    public function messages(){
        return [
            'title.required' => __('Bạn hãy nhập tiêu đề câu hỏi!'),
            'title.min' => __('Question phải có độ dài từ 20 ký tự  trở lên!'),
            'title.unique' => __('Đã có câu hỏi dạng như nay, bạn hãy search để tìm được câu trả lời mong muốn!'),
        ];
    }
}
