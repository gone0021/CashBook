<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kubun extends Model
{
    protected $table = 'kubun';
    protected $guarded = array('id');
    use SoftDeletes;

    /**
     * categoryとのリレーション
     *
     * @return void
     */
    public function item()
    {
        return $this->hasOne('App\Models\Item');
    }

    /**
     * categoryとのリレーション
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /** バリデーションルール */
    public static $ruleCreate = [
        'account_type' => 'required|integer',
        'category_id' => 'required|integer',
        'kubun_name' => 'required|max:20',
    ];

    /** バリデーションエラーメッセージ */
    public static $msgCreate = [
        'account_type.required' => '科目区分を選択してください',
        'account_type.integer' => '科目区分が不正です',
        'category_id.required' => '科目名を選択してください',
        'category_id.integer' => '科目名が不正です',
        'kubun_name.required' => '科目名を入力してください',
        'kubun_name.max' => '科目名は20文字までで入力してください',
    ];

    /** バリデーションルール */
    public static $ruleEdit = [
        'account_type' => 'required|integer',
        'category_id' => 'required|integer',
        'kubun_id' => 'required|integer',
        'kubun_name' => 'required|max:20',
    ];

    /** バリデーションエラーメッセージ */
    public static $msgEdit = [
        'account_type.required' => '科目区分を選択してください',
        'account_type.integer' => '科目区分が不正です',
        'category_id.required' => '科目名を選択してください',
        'category_id.integer' => '科目名が不正です',
        'kubun_id.required' => '小科目名を選択してください',
        'kubun_id.integer' => '小科目名が不正です',
        'kubun_name.required' => '変更名を入力してください',
        'kubun_name.max' => '変更名は20文字までで入力してください',
    ];

    /** バリデーションルール */
    public static $ruleDel = [
        'account_type' => 'required|integer',
        'category_id' => 'required|integer',
        'kubun_id' => 'required|integer',
    ];

    /** バリデーションエラーメッセージ */
    public static $msgDel = [
        'account_type.required' => '科目区分を選択してください',
        'account_type.integer' => '科目区分が不正です',
        'category_id.required' => '科目名を入力してください',
        'category_id.integer' => '科目名が不正です',
        'kubun_id.required' => '小科目名を入力してください',
        'kubun_id.integer' => '小科目名が不正です',
    ];
}
