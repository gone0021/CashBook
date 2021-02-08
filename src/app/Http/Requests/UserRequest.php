<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// ---
use Illuminate\Validation\Rule;
use App\Rules\Current;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        $name = '/^[a-zA-Z0-9]+$/u';
        $pass = '/(?=.*?[a-z])(?=.*?[0-9])[a-z0-9]/';

        return [
            'user_name' => [
                // "regex:$name",
                'required',
                'max:100',
                Rule::unique('users')->ignore(Auth::id()),
                // Rule::unique('user')->ignore(Auth::deleted_at()),
            ],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'birthday' => ['date'],
            'password' => ['string', 'min:8', 'confirmed', "regex:$pass"],
            // テスト用
            // 'password' => ['string', 'min:2', 'confirmed',],
            'current_password' => new Current(),
        ];
    }

    public function messages()
    {
        return [
            // 'user_name.regex' => '半角英数字のみ',
            'user_name.max' => '100文字まで',
            'user_name.unique' => '登録があります',
            'email.email' => 'メールアドレスを入力してください',
            'email.max' => '255文字まで',
            'email.unique' => '登録があります',
            'birthday.date' => '日付を入力してください',
            'password.min' => '8文字以上',
            'password.regex' => '半角英数字を含めて入力してください',
            'password.confirmed' => 'パスワードが異なります',
        ];
    }
}
