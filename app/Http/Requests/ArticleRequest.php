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
            'title' => 'required|max:50',
            'body' => 'required|max:200',
            'category_id' => 'required|exists:App\Models\Category,id',
            'posted_at' => 'nullable|date',
            'public_flag' => '',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルの文字数を50文字以内にしてください。',
            'body.required' => '本文を入力してください。',
            'body.max' => '本文の文字数を200文字以内にしてください。',
            'category_id.required' => 'カテゴリーを選択してください。',
            'category_id.exists' => 'カテゴリーのIDが間違っています。',
            'posted_at.date' => '投稿日時の形式に誤りがあります。',
        ];
    }    
}
