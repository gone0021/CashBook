<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Kubun;
use Facade\FlareClient\Http\Exceptions\BadResponse;

class Item extends Model
{
    protected $table = 'items';

    protected $guarded = array('id');
    use SoftDeletes;

    /**
     * usersとのリレーション
     * @return void
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * categoryとのリレーション
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
        // return $this->hasOne('App\Models\Category');
    }

    /**
     * kubunとのリレーション
     * @return void
     */
    public function kubun()
    {
        return $this->belongsTo('App\Models\Kubun');
    }

    /**
     * ユーザーidと対象月のレコードを取得
     */
    public static function getItem($user_id, $date)
    {
        return Item::where('user_id', $user_id)->where('date', 'like', "$date%");
    }


    /**
     * book_noごとの合計金額を取得
     * 借方で計算してるけど、どっちでもいい
     * @param int $user_id
     * @param int $book_no
     * @return int
     */
    public static function getTotalPriceByBookno($user_id, $book_no)
    {
        $items = Item::where('user_id', $user_id)->where('book_no',$book_no)->where('debit_credit',1)->get();

        $ret = 0;
        foreach ($items as $v) {
            $ret += $v->price;
        }
        return $ret;
    }

    /**
     * 最後のbook_noを取得
     * @return int
     */
    public static function getBookNo()
    {
        return Item::max('book_no');
    }

    /**
     * 資産科目の取得（貸方）
     */
    public static function getCreditCashAsset($user_id, $date)
    {

        $ret = self::getItem($user_id, $date)
            ->where(function ($query) {
                $query->where('category_id', 1)
                    ->orWhere('category_id', 2)
                    ->orWhere('category_id', 3);
            })
            ->where('debit_credit', 2);

        return $ret;
    }

    /**
     * 資産科目の取得（借方）
     */
    public static function getDevitCashAsset($user_id, $date)
    {
        $ret = self::getItem($user_id, $date)
            ->where(function ($query) {
                $query->where('category_id', 1)
                    ->orWhere('category_id', 2)
                    ->orWhere('category_id', 3);
            })
            ->where('debit_credit', 1);

        return $ret;
    }


    /**
     * 該当user_idのフィールド数を取得
     * @return array
     */
    public static function countDebitCreditByBookNo($user_id, $date, $debit_credit)
    {
        $ret = array();
        $val = self::getItem($user_id, $date)->get();

        $flg = 0;
        foreach ($val as $v) {
            $no = (int)$v->book_no;

            $count = $v->where('book_no', $no)->where('debit_credit', $debit_credit)->count();
            if ($count > 2 && $flg != $no) {
                $ret[] = $v->book_no;
                $flg = $no;
                return $ret;
            }
        }
    }
}
