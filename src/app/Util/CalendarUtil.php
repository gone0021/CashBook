<?php

namespace App\Util;

use App\Facades\Calendar;

use Carbon\Carbon;
use DateTime;
use Yasumi\Yasumi;

class CalendarUtil
{
    /**
     * カレンダーデータを返却する
     * @return array
     */
    public function getWeeks()
    {
        // 出力する変数名
        $weeks = [];
        $week = '';

        // ------------------------
        // カレンダーの作成
        // ------------------------
        $carbon = new Carbon(self::getYm_firstday());
        $day_of_week = $carbon->dayOfWeek; // 曜日
        $days = $carbon->daysInMonth; // その月の日数

        // 1週目に空のセルを追加
        $week .= str_repeat('<td></td>', $day_of_week);

        // 祝日の取得用
        $month = Carbon::parse(self::getYm_firstday())->format('Y');
        $yasumi = Yasumi::create('Japan', $month, 'ja_JP');

        // ------------------------
        // items
        // ------------------------
        // 検索の日付
        $val['date'] = Calendar::getYm();

        // ------------------------
        // その他
        // ------------------------
        // 日付の取得
        $year = self::getYear();
        $month = sprintf('%02d', self::getMonth());
        // $month = self::getMonth();

        // ------------------------
        // 日～土のループ
        // ------------------------
        for ($i = 1; $i <= $days; $i++, $day_of_week++) {
            // itemsの取得0
            $day = sprintf('%02d', $i);
            $val['day'] = $day;

            $income_sum = ItemUtil::calcSumIncme($val);
            $expense_sum = ItemUtil::calcSumExpence($val);
            $totalPrice = $income_sum - $expense_sum;

            // リンクの作成
            $linkDate = '?year=' . $year . '&month=' . $month . '&day=' . $day . '&calendar=1';

            // 当日チェック用の日付文字列
            $date = $year . '-' . $month . '-' . $i;
            // $date = self::getYm() . '-' . $i;
            $dateTime = new DateTime($date);
            // $dateTime = Carbon::parse($date);

            // dbアイテムの有無とtitleの取得
            $html = '';
            if ($totalPrice) {
                if ($totalPrice < 0) {
                    $html = '<p class="hasItem minus"><a href="' .  route('items/index')  . $linkDate . '">￥' . number_format($totalPrice) . '</a></p>';
                } else {
                    $html = '<p class="hasItem plus"><a href="' .  route('items/index')  . $linkDate . '">￥' . number_format($totalPrice) . '</a></p>';

                }
            }

            // 当日の判定：styleの設定
            if (Carbon::now()->format('Y-m-j') !== $date) {
                // 祝日のチェック
                if (empty($yasumi->isHoliday($dateTime))) {
                    $week .= '<td class="cld">' . $i . $html;
                } else {
                    $week .= '<td class="cld holiday">' . $i . '<p>' . $this->getHolidayNmae($dateTime, $date) . '</p>' . $html;
                }
            } else {
                // 祝日のチェック
                if (empty($yasumi->isHoliday($dateTime))) {
                    $week .= '<td class="today">' . $i . $html;
                } else {
                    $week .= '<td class="today">' . $i . '<pre>' . $this->getHolidayNmae($dateTime, $date) . '</pre>' . $html;
                }
            }
            // タグ
            $week .= '</td>';

            // 週の終わりの改行、または月末の改行と空白tdタグ
            if (($day_of_week % 7 === 6) || ($i === $days)) {
                // 月末の空白tdタグ
                if ($i === $days) {
                    $week .= str_repeat('<td></td>', 6 - ($day_of_week % 7));
                }
                // タグ
                $weeks[] = '<tr>' . $week . '</tr>';
                // 初期化
                $week = '';
            }
        }

        return $weeks;
    }

    /**
     * 祝日名の取得
     * $date引数から日付を取得してメソッド内で処理を完結
     * @return string
     */
    // 祝日名の取得
    public function getHolidayNmae(DateTime $year, String $date): string
    {
        $holidays = Yasumi::create('Japan', (int)$year->format('Y'), 'ja_JP');
        $results  = [];
        foreach ($holidays->getHolidays() as $holiday) {
            $results[$holiday->format('Y-m-j')] = $holiday->getName();
        }
        return $results[$date];
    }

    /**
     * 引数の値の有無を確認して'Y'を返す
     * @return string
     */
    public static function getYear()
    {
        if (isset($_GET['year'])) {
            $ret = $_GET['year'];
        } else {
            $ret = Carbon::now()->format('Y');
        }
        return $ret;
    }

    /**
     * $_GETを確認して'm'を返す
     * @return string
     */
    public static function getMonth()
    {
        if (isset($_GET['month'])) {
            $ret = $_GET['month'];
        } else {
            $ret = Carbon::now()->format('m');
        }
        return $ret;
    }

    /**
     * GETの値を判定してY-mフォーマット
     * @return string
     */
    public static function getYm()
    {
        $year = Carbon::now()->format('Y');
        if (isset($_GET['year'])) {
            $year = $_GET['year'];
        }
        $month = Carbon::now()->format('m');
        if (isset($_GET['month'])) {
            $month = sprintf('%02d', $_GET['month']);
        }

        if ($year && $month) {
            $ret = Carbon::parse("$year-$month")->format('Y-m');
        } elseif ($year) {
            $ret = Carbon::now()->format("$year-m");
        } elseif ($month) {
            $ret = Carbon::now()->format("Y-$month");
        } else {
            $ret = Carbon::now()->format('Y-m');
        }

        return $ret;
    }

    /**
     * 月初の文字列：算出に使用
     * @return string
     */
    private static function getYm_firstday()
    {
        // self::getYearMonth(($_GET['year']),($_GET['month']));
        return self::getYm() . '-01';
    }

    /**
     * 表示する値
     *
     * @return string
     */
    public static function getDisplayYm()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y年n月');
    }

    /**
     * 前月
     * @return string
     */
    public static function getPrev()
    {
        return Carbon::parse(self::getYm_firstday())->subMonthsNoOverflow();
    }

    /**
     * 翌月
     * @return string
     */
    public static function getNext()
    {
        return Carbon::parse(self::getYm_firstday())->addMonthNoOverflow();
    }
}
