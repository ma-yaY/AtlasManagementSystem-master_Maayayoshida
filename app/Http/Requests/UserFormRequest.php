<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|min:2|max:12',
            'over_name_kana' => 'required|string|min:2|max:12',
            'under_name_kana' => 'required|string|min:2|max:12',
            'mail_address' => 'required|string|min:5|max:40|unique:users,email',
            'sex' => 'required',
            'old_year' => 'required',
            'old_month' => 'required',
            'role' => 'required',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required|string|min:8|max:30',
        ];
    }

    public function messages(){
        return [
            'over_name.required' => '名前は必須項目です。',
            'over_name.string' => '名前は文字列で入力してください。',
            'over_name.max' => '名前は10文字以内で入力してください。',

            'under_name.required' => '苗字は必須項目です。',
            'under_name.string' => '苗字は文字列で入力してください。',
            'under_name.max' => '苗字は10文字以内で入力してください。',

            'over_name_kana.required' => '名前カタカナは必須項目です。',
            'over_name_kana.string' => '名前カタカナは文字列で入力してください。',
            'over_name.max' => '名前カタカナは10文字以内で入力してください。',

            'under_name_kana.required' => '苗字カタカナは必須項目です。',
            'under_name_kana.string' => '苗字カタカナは文字列で入力してください。',
            'under_name_kana.max' => '苗字は10文字以内で入力してください。',

            'mail_address.required' => 'メールアドレスは必須項目です。',
            'sex.required' => '性別は必須項目です。',
            'old_year.required' => '年齢は必須項目です。',
            //'old_year' => '2000年1月1日から今日まで',
            //'old_month' => '2000年1月1日から今日まで',
            'role.required' => 'チェック必須項目です。',
            'password.required' => 'パスワードは必須項目です。',
        ];
    }
}
