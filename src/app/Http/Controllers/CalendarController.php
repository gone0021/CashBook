<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Util\ItemUtil;

use App\Facades\Calendar;
use Carbon\Carbon;
use App\Util\CalendarUtil;

class CalendarController extends Controller
{
    public function __construct(CalendarUtil $Util)
    {
        $this->Util = $Util;
    }

    public function index(Request $req)
    {
        // ------------------------
        // 共通
        // ------------------------
        // 日付
        $getYm = Calendar::getYm();
        $val['date'] = $getYm;
        if ($req->date) {
            $day = sprintf('%02d', $req->day);
            $val['day'] = $day;
        }
        // 合計金額
        $income_sum = ItemUtil::calcSumIncme($val);
        $expense_sum = ItemUtil::calcSumExpence($val);

        // ------------------------
        // 借方の取得
        // ------------------------
        $val['debit_credit'] = 1;

        // ------------------------
        // 貸方の取得
        // ------------------------
        $val['debit_credit'] = 2;

        // ------------------------
        // その他
        // ------------------------
        $param = [
            'displayYm' => CalendarUtil::getDisplayYm(),
            'getMonth' => CalendarUtil::getMonth(),
            'getYear' => CalendarUtil::getYear(),
            'nextMonth' => Calendar::getNext()->format('m'),
            'nextYear' => Calendar::getNext()->format('Y'),
            'prevMonth' => Calendar::getPrev()->format('m'),
            'prevYear' => Calendar::getPrev()->format('Y'),
            'weeks' => Calendar::getweeks(),
            'thisYear' => Carbon::now()->format('Y'),
            'accountType' => array("資産", "費用", "収入",),
            'titles' => array("日", "月", "火", "水", "木", "金", "土"),
            'expense_sum' => $expense_sum,
            'income_sum' => $income_sum,
        ];
        return view('calendar', $param);
    }
}
