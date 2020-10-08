<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    protected $guarded = array('id');
    use SoftDeletes;

    /**
     * usersとのリレーション
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
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

    /**
     * categoryとのリレーション
     *
     * @return void
     */
    public function kubun()
    {
        return $this->belongsTo('App\Models\Kubun');
    }

    /**
     * 月でレコードを取得
     * グループ別：タイプ別
     */
    public static function getItemByDate($user_id, $date)
    {
        $ret = Item::where('user_id', $user_id)
            ->where('date', $date)
            ->whereNull('is_deleted');
        return $ret;
    }


    /**
     * ユーザーidと対象月のレコードを取得
     */
    public static function getItem($user_id, $date)
    {

        $ret = Item::where('user_id', $user_id)->where('date', 'like', "$date%");

        return $ret;
    }

    /**
     * ユーザーidと対象月のレコードを取得
     */
    public static function getCreditCashAsset($user_id, $date)
    {

        $ret = self::getItem($user_id, $date)
            ->where(function ($query) {
                $query->where('category_id', 1)
                    ->orWhere('category_id', 2)
                    ->orWhere('category_id', 3);
            })
            ->where('account_type', 1)
            ->where('debit_credit', 2);

        return $ret;
    }

    /**
     * ユーザーidと対象月のレコードを取得
     */
    public static function getDevitCashAsset($user_id, $date)
    {
        $ret = self::getItem($user_id, $date)
            ->where(function ($query) {
                $query->where('category_id', 1)
                    ->orWhere('category_id', 2)
                    ->orWhere('category_id', 3);
            })
            ->where('account_type', 1)
            ->where('debit_credit', 1);

        return $ret;
    }
}
