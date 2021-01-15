<?php

namespace App\Util;

use App\Models\Item;

class ItemUtil
{
    /**
     * itemsの合計金額を返す
     *
     * @return int
     */
    public static function calcSum($items)
    {
        $ret = 0;
        foreach ($items as $k) {
            $ret += $k->price;
        }
        return $ret;
    }

    /**
     * 収益の合計を返す
     * 貸借の検索値は不要
     *
     * @return int
     */
    public static function calcSumIncme($val)
    {
        // 借方
        $val['debit_credit'] = 1;
        $debit = Item::getIncome($val)->get();
        $debit_sum = 0;
        foreach ($debit as $v) {
            $debit_sum += $v->price;
        }

        // 貸方
        $val['debit_credit'] = 2;
        $credit = Item::getIncome($val)->get();
        $credit_sum = 0;
        foreach ($credit as $v) {
            $credit_sum += $v->price;
        }

        $ret = $credit_sum - $debit_sum;
        return $ret;
    }

    /**
     * 費用の合計を返す
     * 貸借の検索値は不要
     *
     * @return int
     */
    public static function calcSumExpence($val)
    {
        // 借方
        $val['debit_credit'] = 1;
        $debit = Item::getExpense($val)->get();
        $debit_sum = 0;
        foreach ($debit as $v) {
            $debit_sum += $v->price;
        }

        // 貸方
        $val['debit_credit'] = 2;
        $credit = Item::getExpense($val)->get();
        $credit_sum = 0;
        foreach ($credit as $v) {
            $credit_sum += $v->price;
        }

        $ret = $credit_sum - $debit_sum;
        return $ret;
    }

    /**
     * book_noが複数ある場合に値を取得：decit_creditで確認している
     * @param array $val：検索値
     * @param int $debit_credit：1->借方、２->貸方
     *
     * @return array
     */
    public static function countDebitCreditByBookNo($val)
    {
        $imtes = Item::getItem($val)->get();
        $flg = 0;
        $ret = array();

        foreach ($imtes as $v) {
            $num = $v->book_no;

            $count = $v->where('book_no', $num)->where('debit_credit', $val['debit_credit'])->count();
            if ($count > 1 && $flg !== $num) {
                $ret[] = $num;
                $flg = $num;
            }
        }
        return $ret;
    }
}
