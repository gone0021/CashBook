<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Rules\Current;

class User extends Model
{
    protected $guarded = array('id');
    use SoftDeletes;

    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }

    /** バリデーションルール */
    public static $rules = [
        'email' => ['string', 'email', 'max:255'],
        'birthday' => ['date'],
    ];

    /** バリデーションエラーメッセージ */
    public static $messages = [
        'email.email' => 'メールアドレスを入力してください',
        'email.max' => '255文字まで',
        'birthday.date' => '日付を入力してください',
    ];
}
