<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            /*カテゴリー登録系*/
            'main_category_id' => 'required|exists:sub_categories',
            'sub_category' =>'required|max:100|string|min:1|unique:sub_categories',

            'post_title' => 'min:4|max:50',
            'post_body' => 'min:10|max:500',
        ];
    }

    public function messages(){
        return [
            'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは50文字以内で入力してください。',
            'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.max' => '最大文字数は500文字です。',

            /*カテゴリー登録系*/
            'sub_category.required' => 'サブカテゴリーの入力は必須です。',
            'sub_category.max' => '内容は100文字以内入力してください。',
            'sub_category.string' => '文字列形式で入力してください。',
            'sub_category.min' => '内容は1文字以上入力してください。',
            'sub_category.unique' => '同じ名前のサブカテゴリーは登録できません。',

            'main_category_id.required' => 'メインカテゴリーの選択は必須です。',
            'main_category_id.exists' => '登録されているメインカテゴリーを選択してください。'


        ];
    }
}
