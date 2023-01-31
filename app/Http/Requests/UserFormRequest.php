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
            'under_name' => 'required|string|max:12',
            'over_name_kana' => 'required|string|max:12|regex:/^[ァ-ヾ　〜ー]+$/u',
            'under_name_kana' => 'required|string|max:12|regex:/^[ァ-ヾ　〜ー]+$/u',
            'mail_address' => 'required|string|min:5|max:100|email|unique:users,mail_address',
            'sex' => 'required',
            'old_year' => 'required',
            'old_month' => 'required',
            'role' => 'required',
            'password' => 'required|string|min:8|max:30|confirmed',
            'password_confirmation' => 'required|string|min:8|max:30',
        ];
    }

    public function messages(){
        return [
            'over_name.required' => '名は必須項目です。',
            'over_name.string' => '名は文字列で入力してください。',
            'over_name.max' => '名は10文字以下で入力してください。',

            'under_name.required' => '姓は必須項目です。',
            'under_name.string' => '姓は文字列で入力してください。',
            'under_name.max' => '姓は10文字以下で入力してください。',

            'over_name_kana.required' => 'メイは必須項目です。',
            'over_name_kana.string' => 'メイは文字列で入力してください。',
            'over_name_kana.max' => 'メイは10文字以下で入力してください。',
            'over_name_kana.regex' => 'メイはカタカナで入力してください。',


            'under_name_kana.required' => 'セイは必須項目です。',
            'under_name_kana.string' => 'セイカタカナは文字列で入力してください。',
            'under_name_kana.max' => 'セイは10文字以内で入力してください。',
            'under_name_kana.regex' => 'セイはカタカナで入力してください。',

            'mail_address.required' => 'メールアドレスは必須項目です。',
            'mail_address.email' => 'メールアドレスの形式が違います。',
            'mail_address.unique' => '登録済みのメールアドレスです。',
            'under_name_kana.max' => 'セイは100文字以下で入力してください。',

            'sex.required' => '性別は必須項目です。',

            'old_year.required' => '年齢は必須項目です。',

            'role.required' => 'チェック必須項目です。',

            'password.required' => 'パスワードは必須項目です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは30文字以下で入力してください。',
            'password.confirmed' => '確認用パスワードが違います。',
            'password_confirmation.' => '確認用パスワードは必須項目です。',

        ];
    }
}
