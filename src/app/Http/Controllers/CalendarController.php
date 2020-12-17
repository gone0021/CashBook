<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Facades\Calendar;
use App\Util\CalendarUtil;

class CalendarController extends Controller
{
    private $Util;

    public function __construct(CalendarUtil $Util)
    {
        $this->Util = $Util;
    }

    public function index(Request $req)
    {
        $user_id = Auth::id();

        $param = [
            'group_id' => $req->group_id,
            'item_type' => $req->item_type,
            'lists' => array("全て", "ダイビング", "場所", "予定", ),
            'titles' => array("日", "月", "火", "水", "木", "金", "土"),
            // 'weeks' => Calendar::getWeeks($req->group_id, $req->item_type),
            'month' => Calendar::getMonth(),
            'dispMonth' => Calendar::getDisplayMonth(),
            'thisMonth' => Calendar::getThisMonth(),
            'prev' => Calendar::getPrev(),
            'next' => Calendar::getNext(),
        ];
        return view('calendar', $param);
    }
}
