<?php

namespace App\Services;

use App\helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Item;
use DateTime;
use Illuminate\Support\Facades\DB;
use Yasumi\Yasumi;

class CalendarUtil
{
    /**
     * カレンダーデータを返却する
     *
     * @return array
     */
    public function getWeeks(string $group_id, string $item_type)
    {
        // 出力する値
        $weeks = [];
        $week = '';

        // カレンダーの作成
        $carbon = new Carbon(self::getYm_firstday());
        $day_of_week = $carbon->dayOfWeek; // 曜日
        $days = $carbon->daysInMonth; // その月の日数

        // 祝日の取得用
        $month = Carbon::parse(self::getYm_firstday())->format('Y');
        $yasumi = Yasumi::create('Japan', $month, 'ja_JP');

        // ※ dbアイテム値の初期化
        $item = '';
        $selectItems = $this->selectItems($group_id, $item_type);

        // 1週目に空のセルを追加
        $week .= str_repeat('<td></td>', $day_of_week);

        // 7日分（日～土）のループ
        for ($day = 1; $day <= $days; $day++, $day_of_week++) {
            $date = self::getYm() . '-' . $day;
            $dateTime = new DateTime($date);

            // aタグでアイテム数を表示
            $link = '<a href=" '.  url('date_items')  . '?date=' . $dateTime->format('Y-m-d')  . '&group_id=' . $group_id . '&item_type=' . $item_type . '" class="has-item">';


            // dbアイテムの有無とtitleの取得
            foreach ($selectItems as $k => $v) {
                if ($k == $dateTime->format('Y-m-d')) {
                    // 出力
                    $item = '<p class="has-item">' . $link . $v . '</a></p>';
                    // $item = '<p class="has-item">' . $v . '</p>';
                    break;
                } else {
                    $item = '';
                }
            }

            // 当日の判定
            if (Carbon::now()->format('Y-m-j') !== $date) {
                // 祝日のチェック
                if (empty($yasumi->isHoliday($dateTime))) {
                    $week .= '<td class="cld">' . $day . $item;
                } else {
                    $week .= '<td class="cld holiday">' . $day . '<p>' . $this->getHolidayNmae($dateTime, $date) . '</p>' . $item;
                }
            } else {
                // 祝日のチェック
                if (empty($yasumi->isHoliday($dateTime))) {
                    $week .= '<td class="today">' . $day . $item;
                } else {
                    $week .= '<td class="today">' . $day . '<pre>' . $this->getHolidayNmae($dateTime, $date) . '</pre>' . $item;
                }
            }
            // 出力
            $week .= '</td>';
            // }

            // 週の終わりの改行、または月末の改行と空白tdタグ
            if (($day_of_week % 7 === 6) || ($day === $days)) {
                // 月末の空白tdタグ
                if ($day === $days) {
                    $week .= str_repeat('<td></td>', 6 - ($day_of_week % 7));
                }
                // 出力
                $weeks[] = '<tr>' . $week . '</tr>';
                $week = '';
            }
        }

        return $weeks;
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
