<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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



    public function getValidatorInstance()
    {

            $old_year = $this->input('old_year');
            $old_month = $this->input('old_month');
            $old_day = $this->input('old_day');
            //select()だとうまくいかなかった。ここでは＄requestは使わず＄this

            //変数結合
            //$birthDate = implode('-', $this->only(['old_year', 'old_month', 'old_day']));

            $birth_day = $old_year . '-' . $old_month . '-' . $old_day;
            $this->merge([
                'birth_day' => $birth_day,
            ]);


        return parent::getValidatorInstance();
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
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|max:30|regex:/^[ァ-ヾ　〜ー]+$/u',
            'under_name_kana' => 'required|string|max:30|regex:/^[ァ-ヾ　〜ー]+$/u',
            'mail_address' => 'required|string|max:100|email|unique:users,mail_address',
            'sex' => ['required', 'regex:/^[1|2|3]+$/u'],
            'birth_day' => 'required|date|after:2000-01-01|before:now',// 正しい日付かどうかをチェック
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

            'over_name_kana.required' => 'セイは必須項目です。',
            'over_name_kana.string' => 'セイは文字列で入力してください。',
            'over_name_kana.max' => 'セイは30文字以下で入力してください。',
            'over_name_kana.regex' => 'セイはカタカナで入力してください。',


            'under_name_kana.required' => 'メイは必須項目です。',
            'under_name_kana.string' => 'メイは文字列で入力してください。',
            'under_name_kana.max' => 'メイは30文字以内で入力してください。',
            'under_name_kana.regex' => 'メイはカタカナで入力してください。',

            'mail_address.required' => 'メールアドレスは必須項目です。',
            'mail_address.email' => 'メールアドレスの形式が違います。',
            'mail_address.unique' => '登録済みのメールアドレスです。',

            'sex.required' => '性別は必須項目です。',
            'sex.regex' => '男性、女性、その他以外無効',

            'birth_day.required' => '日付は必須項目です。',
            'birth_day.date'  => 'この日付は存在しません。',
            'birth_day.before' => '今日までの日付を入力。',
            'birth_day.after' => '2000年1月1日以降の日付を入力。',

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
