<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Carbon\Carbon;
use App\Util\ItemUtil;

use App\Models\Category;
use App\Models\Kubun;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\VarDumper\VarDumper;

class ItemController extends Controller
{
    public function index(Request $req)
    {
        $user_id = Auth::id();

        // インスタンス
        $carbon = new Carbon('now');
        $itemUtil = new ItemUtil;

        // 変数の設定
        $getYear = sprintf('%04d', $req->year);
        $getMonth = sprintf('%02d', $req->month);
        $thisYear = $carbon->format('Y');

        // getの有無で年と月を設定（表示用）
        $getYear = ItemUtil::getThisYear($req->year);
        $getMonth = ItemUtil::getThisMonth($req->month);

        // getの有無で年月を設定（計算用）
        $yearMmonth = ItemUtil::getyearMonth($req->year, $req->month);
        $getItem = Item::getItem($user_id, $yearMmonth);
        $items = $getItem->get();

        // book_noの個数を表示するため数のカウントに使用
        $bookNo = $getItem->groupBy('book_no')->paginate(7);

        // 該当するbook_noのdebit_creditを数える
        $countDebit = $itemUtil->countDebitCreditByBookNo($user_id, $yearMmonth, 1);
        $countCredit = $itemUtil->countDebitCreditByBookNo($user_id, $yearMmonth, 2);

        // 金額の計算
        $credits = Item::getCreditCashAsset($user_id, $yearMmonth)->get();
        $debits = Item::getDevitCashAsset($user_id, $yearMmonth)->get();

        $creditSum = ItemUtil::getSum($credits);
        $debitSum = ItemUtil::getSum($debits);
        $cashTotal = $debitSum + $creditSum;

        $param = [
            'cashTotal' => $cashTotal,
            'countDebit' => $countDebit,
            'countCredit' => $countCredit,
            'bookNo' => $bookNo,
            'getMonth' => $getMonth,
            'getYear' => $getYear,
            'items' => $items,
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
        $user_id = Auth::id();

        unset($req['_token']);
        $nextNo = Item::getBookNo() + 1;

        // for ($i=0; $i<count($req->debit_credit); $i++) {
        foreach ($req->Input('debit_credit') as $k => $v) {
            $dbItem = new Item();

            $dbItem->user_id = $user_id;
            $dbItem->book_no = $nextNo;
            $dbItem->debit_credit = $req->debit_credit[$k];
            $dbItem->date = $req->date;
            $dbItem->category_id = $req->category_id[$k];
            if ($req->kubun_id[$k] == 'null') {
                $dbItem->kubun_id = null;
            } else {
                $dbItem->kubun_id = $req->kubun_id[$k];
            }
            $dbItem->price = $req->price;
            $dbItem->comment = $req->comment;
            $dbItem->save();
        }
        return back();
    }

    public function showAjax(Request $req)
    {
        $user_id = Auth::id();

        $select = ['items.id','items.user_id','items.book_no','items.date','debit_credit','items.category_id','c.category_name','items.kubun_id','k.kubun_name','items.price'];

        $items = Item::select($select)->join('category as c','items.category_id','c.id')->leftjoin('kubun as k','items.kubun_id','k.id')->where('user_id', $user_id)->where('book_no', (int)$req->book_no)->get();
        // return view('/items/detail', ['items'=>$items]);
        return $items;

    }

    public function edit(Request $req)
    {
        $user_id = Auth::id();

        $items = Item::where('user_id', $user_id)->where('book_no', (int)$req->book_no)->get();
        return view('/items/detail', ['items'=>$items]);
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
