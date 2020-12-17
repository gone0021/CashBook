<?php

namespace App\Util;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Category;
use App\Models\Kubun;

use DateTime;
use Illuminate\Support\Facades\DB;

class ItemUtil
{
    /**
     * valの合計を返す
     *
     * @return int
     */
    public static function getSum($val)
    {
        $ret = 0;
        foreach ($val as $k) {
            $ret += $k->price;
        }
        return $ret;
    }

    /**
     * 引数の値の有無を確認して年月を取得
     *
     * @return string
     */
    public static function getYearMonth($year, $month)
    {
        $getMonth = sprintf('%02d', $month);

        if ($year && $month) {
            $ret = Carbon::now()->format("$year-$getMonth");
        } elseif ($year) {
            $ret = Carbon::now()->format("$year-m");
        } elseif ($month) {
            $ret = Carbon::now()->format("Y-$getMonth");
        } else {
            $ret = Carbon::now()->format("Y-m");
        }
        return $ret;
    }

    /**
     * 引数の値の有無を確認して'Y'を返す
     *
     * @return string
     */
    public static function getThisYear($year)
    {
        if ($year != 0) {
            $ret = $year;
        } else {
            $ret = Carbon::now()->format('Y');
        }
        return $ret;
    }

    /**
     * 引数の値の有無を確認して'm'を返す
     *
     * @return string
     */
    public static function getThisMonth($month)
    {
        if ($month != 0) {
            $ret = $month;
        } else {
            $ret = Carbon::now()->format('m');
        }
        return $ret;
    }


    /**
     * user_idのフィールド数を取得
     *
     * @return string
     */
    public function getCountByUserId()
    {
        //
    }

    /**
     * book_noのdecit_credit数をカウント
     *
     * @return array
     */
    public static function countDebitCreditByBookNo($user_id, $date, $debit_credit)
    {
        $val = Item::getItem($user_id, $date)->get();
        $flg = 0;
        $ret = array();

        foreach ($val as $v) {
            $num = (int)$v->book_no;

            $count = $v->where('book_no', $num)->where('debit_credit', $debit_credit)->count();
            if ($count > 1 && $flg !== $num) {
                $ret[] = $num;
                $flg = $num;
            }
        }
        return $ret;
    }
}
