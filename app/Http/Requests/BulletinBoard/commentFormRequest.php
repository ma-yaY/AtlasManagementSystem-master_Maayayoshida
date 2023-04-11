<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class commentFormRequest extends FormRequest
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
            'comment' => 'required|max:2500|string',
        ];
    }

    public function messages(){
        return [

            'comment.required' => '入力は必須です。',
            'comment.max' => '2500文字以内で入力してください。',
            'comment.string' => '文字列で入力してください。',

        ];
    }
}
