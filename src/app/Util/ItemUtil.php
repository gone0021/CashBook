<?php

namespace App\Util;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use DateTime;
use Illuminate\Support\Facades\DB;

class ItemUtil
{
    public function getSum($val){
        $sum = 0;
        foreach($val as $k) {
            $sum += $k->price;
        }
    }



    /**
     * 祝日名の取得
     * $date引数から日付を取得してメソッド内で処理を完結
     *
     * @return string
     */
    // 祝日名の取得
    function getHolidayNmae(DateTime $year, String $date): string
    {
        $holidays = Yasumi::create('Japan', (int)$year->format('Y'), 'ja_JP');
        $results  = [];
        foreach ($holidays->getHolidays() as $holiday) {
            $results[$holiday->format('Y-m-j')] = $holiday->getName();
        }
        return $results[$date];
    }


    /**
     * requestに合ったdb値を取得
     *
     * @return object
     */
    public function selectItems(string $group_id, string $item_type)
    {
        if ($group_id > 0 && $item_type > 0) {
            return $this->countItemsGroupByType($group_id, $item_type);
        } elseif ($group_id > 0 && $item_type == 0) {
            return $this->countItemsGroupAllType($group_id);
        } elseif ($group_id == 0 && $item_type > 0) {
            return $this->countItemsPersonByType($item_type);
        } elseif ($group_id == 0 && $item_type == 0) {
            return $this->countItemsPersonAllType();
        }
    }

    /**
     * items 該当日のアイテム数を取得（個人：全て）
     *
     * @return object
     */
    public function countItemsPersonAllType()
    {
        $a_id = Auth::id();
        $serch = DB::raw(Item::unionAllNoGroup());

        $imtes = DB::table($serch)
            ->select("item_id", "item_type", "title", "date", DB::raw("count(title) as t"), "uid", "status")
            ->where('uid', $a_id)
            ->whereNull('is_deleted')
            ->groupBy('date')
            ->get();

        $results  = [];
        foreach ($imtes as $item) {
            $results[$item->date] = $item->t;
        }

        return $results;
    }


    /**
     * items 該当日のアイテム数を取得（個人：タイプ別）
     *
     * @return object
     */
    public function countItemsPersonByType(String $item_type)
    {
        $a_id = Auth::id();
        $serch = DB::raw(Item::unionAllNoGroup());

        $imtes = DB::table($serch)
            ->select("item_id", "item_type", "title", "date", DB::raw("count(title) as t"), "uid", "status")
            ->where('uid', $a_id)
            ->where('item_type', $item_type)
            ->whereNull('is_deleted')
            ->groupBy('date')
            ->get();

        $results  = [];
        foreach ($imtes as $item) {
            $results[$item->date] = $item->t;
        }

        return $results;
    }

    /**
     * items 該当日のアイテム数を取得（グループごと：全て）
     *
     * @return object
     */
    public function countItemsGroupAllType(String $group_id)
    {
        $group = Group::find($group_id);
        // ダイビング関連のグループかどうかを判定して取得するselectを選択
        $serch = item::checkDivingGroup($group->group_type);

        $imtes = DB::table($serch)
            ->select("item_id", "item_type", "title", "date", DB::raw("count(title) as t"), "uid", "status")
            ->where('group_id', $group_id)
            ->whereNull('is_deleted')
            ->groupBy('date')
            ->get();

        $results  = [];
        foreach ($imtes as $item) {
            $results[$item->date] = $item->t;
        }

        return $results;
    }

    /**
     * items 該当日のアイテム数を取得（グループごと：タイプ別）
     *
     * @return object
     */
    public function countItemsGroupByType(String $group_id, String $item_type)
    {
        $group = Group::find($group_id);
        // ダイビング関連のグループかどうかを判定して取得するselectを選択
        $serch = Item::checkDivingGroup($group->group_type);

        $imtes = DB::table($serch)
            ->select("item_id", "item_type", "title", "date", DB::raw("count(title) as t"), "uid", "status")
            ->where('group_id', $group_id)
            ->where('item_type', $item_type)
            ->whereNull('is_deleted')
            ->groupBy('date')
            ->get();

        $results  = [];
        foreach ($imtes as $item) {
            $results[$item->date] = $item->t;
        }

        return $results;
    }


    /**
     * month 文字列を返却する
     *
     * @return string
     */
    public function getMonth()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y年n月');
    }

    /**
     * 表示月の文字列（Y-m）を返却する
     *
     * @return string
     */
    public function getDisplayMonth()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y-m');
    }

    /**
     * 今月の文字列（Y-m）を返却する
     *
     * @return string
     */
    public function getThisMonth()
    {
        return Carbon::now()->format('Y-m');
    }

    /**
     * prev 文字列を返却する
     *
     * @return string
     */
    public function getPrev()
    {
        return Carbon::parse(self::getYm_firstday())->subMonthsNoOverflow()->format('Y-m');
    }

    /**
     * next 文字列を返却する
     *
     * @return string
     */
    public function getNext()
    {
        return Carbon::parse(self::getYm_firstday())->addMonthNoOverflow()->format('Y-m');
    }

    /**
     * GET から Y-m フォーマットを返却する
     *
     * @return string
     */
    private static function getYm()
    {
        if (isset($_GET['ym'])) {
            return $_GET['ym'];
        }
        return Carbon::now()->format('Y-m');
    }

    /**
     * 2019-09-01 のような月初めの文字列を返却する
     *
     * @return string
     */
    private static function getYm_firstday()
    {
        return self::getYm() . '-01';
    }
}
