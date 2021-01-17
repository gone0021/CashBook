<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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
     * レコードの取得：sql
     * @param array $val：検索値の配列
     */
    public static function getItem($val)
    {
        $sql = Item::where('user_id', Auth::id());

        if (isset($val['day'])) {
            $date = $val['date'] . '-' . $val['day'];
            $sql = $sql->where('date', $date);
        } elseif (isset($val['date'])) {
            $date = $val['date'];
            $sql = $sql->where('date', 'LIKE', "$date%");
        }

        if (isset($val['debit_credit'])) {
            $sql = $sql->where('debit_credit', $val['debit_credit']);
        }

        if (isset($val['book_no'])) {
            $sql = $sql->where('debit_credit', $val['book_no']);
        }

        return $sql;
    }

    /**
     * レコードの取得：sql
     * getItemをsql文で記述したもの
     * @param array $val：検索値の配列
     */
    public static function getItemSql($val)
    {
        $user_id = Auth::id();
        $sql = "SELECT * FROM items WHERE user_id = $user_id AND deleted_at is null";

        $sql = Item::where('user_id', Auth::id());
        if (isset($val['day'])) {
            $val = $val['date'] . '-' . $val['day'];
            $sql .= " AND date = val ";
        } elseif (isset($val['date'])) {
            $val = $val['date'];
            $sql .= " AND date LIKE val% ";
        }

        if (isset($val['debit_credit'])) {
            $sql .= ' AND debit_credit =' .  $val['debit_credit'];
        }
        return $sql;
    }

    /**
     * book_noごとの合計金額を取得
     * 借方で計算してるけどどっちでもいい
     * @param int $book_no
     * @return int
     */
    public static function getTotalPriceByBookno($book_no)
    {
        $items = Item::where('user_id', Auth::id())->where('book_no', $book_no)->where('debit_credit', 1)->get();

        $ret = 0;
        foreach ($items as $v) {
            $ret += $v->price;
        }
        return $ret;
    }

    /**
     * 日付ごとの合計金額を取得
     * 借方で計算してるけどどっちでもいい
     * @param int $book_no
     * @return int
     */
    public static function getTotalPriceBydate($date)
    {
        $items = Item::where('user_id', Auth::id())->where('date', $date)->where('debit_credit', 1)->get();

        $ret = 0;
        foreach ($items as $v) {
            $ret += $v->price;
        }
        return $ret;
    }

    /**
     * 収益科目の取得
     * @param array $val：検索値
     *
     */
    public static function getIncome($val)
    {
        $category = Category::where('account_type', 2);
        $category = $category->get();

        foreach ($category as $v) {
            $id[] = $v->id;
        }
        // $ids = implode(',',$id);

        $ret = self::getItem($val)->whereIn('category_id', $id);

        return $ret;
    }

    /**
     * 費用科目の取得
     * @param array $val：検索値
     *
     * @return
     */
    public static function getExpense($val)
    {
        $category = Category::where('account_type', 1);
        $category = $category->get();

        foreach ($category as $v) {
            $id[] = $v->id;
        }
        // $ids = implode(',',$id);

        $ret = self::getItem($val)->whereIn('category_id', $id);

        return $ret;
    }

    /** バリデーションルール */
    public static $ruleAccount = [
        'date' => 'required|date|after:2020-01-01',
        'category_id.*' => 'required|integer',
        'kubun_id.*' => 'nullable|integer',
        'price.*' => 'required|integer',
        'comment' => 'nullable|max:100',
    ];

    /** バリデーションエラーメッセージ */
    public static $msgAccount = [
        'date.required' => '日付を入力してください',
        'date.date' => '日付が不正です',
        'date.after' => '2020年以降で入力してください',
        'category_id.*.required' => '科目を選択してください',
        'category_id.*.integer' => '科目が不正です',
        'kubun_id.*.integer' => '小科目が不正です',
        'price.*.required' => '金額をを入力してください',
        'price.*.integer' => '半角整数で入力してください',
        'comment.max'=> '100文字内で入力してください',
    ];

    /** バリデーションルール */
    public static $ruleNomal = [
        'date' => 'required|date|after:2020-01-01',
        'category_id.*' => 'required|integer',
        'kubun_id.*' => 'nullable|integer',
        'price' => 'required|integer',
        'comment' => 'nullable|max:20',
    ];

    /** バリデーションエラーメッセージ */
    public static $msgNomal = [
        'date.required' => '日付を入力してください',
        'date.date' => '日付が不正です',
        'date.after' => '2020年以降で入力してください',
        'category_id.*.required' => '科目を選択してください',
        'category_id.*.integer' => '科目が不正です',
        'kubun_id.*.integer' => '小科目が不正です',
        'price.required' => '金額をを入力してください',
        'price.integer' => '半角整数で入力してください',
        'comment.max'=> '100文字内で入力してください',
    ];
}
