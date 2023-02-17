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
     *  rules()の前に実行される
     *       $this->merge(['key' => $value])を実行すると、
     *       フォームで送信された(key, value)の他に任意の(key, value)の組み合わせをrules()に渡せる
     */
    public function getValidatorInstance()
    {
        // プルダウンで選択された値(= 配列)を取得

        $date = $this->input($old_year, $old_month, $old_day, 'Y-m-d'); //デフォルト値は空の配列

        // 日付を作成(ex. 2020-1-20)
        $date_validation = implode('-', $date);

        // rules()に渡す値を追加でセット
        //     これで、この場で作った変数にもバリデーションを設定できるようになる
        $this->merge([
            'date_validation' => $date_validation,
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
            'under_name' => 'required|string|max:12',
            'over_name_kana' => 'required|string|max:12|regex:/^[ァ-ヾ　〜ー]+$/u',
            'under_name_kana' => 'required|string|max:12|regex:/^[ァ-ヾ　〜ー]+$/u',
            'mail_address' => 'required|string|max:100|email|unique:users,mail_address',
            'sex' => 'required',
            'date_validation' => 'date',// 正しい日付かどうかをチェック(ex. 2020-2-30はNG)
            'role' => 'required',
            'subject[]' =>'subject[]',
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
            'over_name_kana.max' => 'セイは10文字以下で入力してください。',
            'over_name_kana.regex' => 'セイはカタカナで入力してください。',


            'under_name_kana.required' => 'メイは必須項目です。',
            'under_name_kana.string' => 'メイは文字列で入力してください。',
            'under_name_kana.max' => 'メイは10文字以内で入力してください。',
            'under_name_kana.regex' => 'メイはカタカナで入力してください。',

            'mail_address.required' => 'メールアドレスは必須項目です。',
            'mail_address.email' => 'メールアドレスの形式が違います。',
            'mail_address.unique' => '登録済みのメールアドレスです。',

            'sex.required' => '性別は必須項目です。',

            'date_validation.date'  => "存在しない日付です。",

            'role.required' => 'チェック必須項目です。',

            'subject[]' => '教科は必須項目です。',

            'password.required' => 'パスワードは必須項目です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは30文字以下で入力してください。',
            'password.confirmed' => '確認用パスワードが違います。',
            'password_confirmation.' => '確認用パスワードは必須項目です。',

        ];
    }
}
