<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Carbon\Carbon;
use App\Util\ItemUtil;

class ItemController extends Controller
{
    public function index(Request $req)
    {
        $a_id = Auth::id();

        $carbon = new Carbon('now');

        // 変数の設定
        $getYear = sprintf('%04d', $req->year);
        $getMonth = sprintf('%02d', $req->month);
        $thisYear = $carbon->format('Y');
        $thisMonth = $carbon->format('m');

        // 値の有無で年月を設定
        if($req->year && $req->month) {
            $yearMmonth = $carbon->format("$req->year-$getMonth");
        } elseif($req->year) {
            $yearMmonth = $carbon->format("$req->year-m");
        } elseif($req->month) {
            $yearMmonth = $carbon->format("Y-$getMonth");
        } else {
            $yearMmonth = $carbon->format("Y-m");
        }

        // getの有無で年を設定
        if ($req->year != 0) {
            $getYear = $req->year;
        } else {
            $getYear = $carbon->format('Y');
        }

        // getの有無で月を設定
        if ($req->month != 0) {
            $getMonth = $req->month;
        } else {
            $getMonth = $carbon->format('m');
        }

        $dbItem = Item::getItem($a_id, $yearMmonth);

        $items = $dbItem->get();
        // $count = $dbItem->groupBy('book_no')->count();

        $credits = Item::getCreditCashAsset($a_id, $yearMmonth)->get();
        $debits = Item::getDevitCashAsset($a_id, $yearMmonth)->get();

        // dump($thisYear);die;

        // $itemUtil = new ItemUtil;
        // $creditSum = $itemUtil->getSum($credit);
        // dump($creditSum);

        $creditSum = 0;
        foreach($credits as $k) {
            $creditSum += $k->price;
        }

        $debitSum = 0;
        foreach($debits as $k) {
            $debitSum += $k->price;
        }

        $cashTotal = $debitSum + $creditSum;

        $param = [
            'cashTotal' => $cashTotal,
            // 'endYear' => $endYear,
            'items' => $items,
            'getMonth' => $getMonth,
            'getYear' => $getYear,
            'thisMonth' => $thisMonth,
            'thisYear' => $thisYear,
        ];
        return view('/items/index', $param);
    }

    public function create(Request $req)
    {
        //
    }

    public function store(Request $req)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $req, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
