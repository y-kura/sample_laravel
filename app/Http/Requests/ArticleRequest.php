<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:100',
            'body' => 'required|max:1000',
            'category_id' => 'required|exists:App\Models\Category,id',
            'posted_at' => 'nullable|date',
            'public_flag' => '',
        ];
    }

    /**
     * バリデーションのメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'posted_at.date' => '投稿日時の形式に誤りがあります。',
        ];
    }    
}
