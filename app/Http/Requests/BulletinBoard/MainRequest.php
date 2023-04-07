<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainRequest extends FormRequest
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
            'main_category' => 'required|max:100|string|min:1|unique:main_categories',

        ];
    }

    public function messages(){
        return [
            /*カテゴリー登録系*/
            'main_category.required' => 'メインカテゴリーの入力は必須です。',
            'main_category.max' => '内容は100文字以内入力してください。',
            'main_category.string' => '文字列形式で入力してください。',
            'main_category.min' => '内容は1文字以上入力してください。',
            'main_category.unique' => '同じ名前のメインカテゴリーは登録できません。',
        ];
    }
}
