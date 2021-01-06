<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facades\Calendar;
use App\Models\Item;
use Carbon\Carbon;
use App\Util\ItemUtil;

class ItemController extends Controller
{
    public function __construct(ItemUtil $Util)
    {
        $this->Util = $Util;
    }

    public function index(Request $req)
    {
        // ------------------------
        // インスタンス
        // ------------------------
        $carbon = new Carbon('now');

        // ------------------------
        // 貸借共通
        // ------------------------
        // 日付
        $val['date'] = Calendar::getYm();
        if (isset($_GET['day'])) {
            $day = sprintf('%02d', $_GET['day']);
            $val['day'] = $day;
        }
        // itemsテーブルの取得
        $getItem = Item::getItem($val);
        $items = $getItem->get();

        // 表示用：book_noの個数で表示するための個数カウントに使用
        $groupByItems = $getItem->groupBy('book_no')->paginate(7);
        // priceの上書き
        foreach ($groupByItems as $v){
            $sum = Item::getTotalPriceByBookno($v->book_no);
            $v->price = $sum;
        }

        // 合計金額の計算
        $income_sum = ItemUtil::calcSumIncme($val);
        $expense_sum = ItemUtil::calcSumExpence($val);
        $totalPrice = $income_sum - $expense_sum;

        // ------------------------
        // 借方
        // ------------------------
        $val['debit_credit'] = 1;
        $countDebit = ItemUtil::countDebitCreditByBookNo($val);

        // ------------------------
        // 貸方
        // ------------------------
        $val['debit_credit'] = 2;
        $countCredit = ItemUtil::countDebitCreditByBookNo($val);
        // ------------------------
        // その他
        // ------------------------


        $param = [
            'countDebit' => $countDebit,
            'countCredit' => $countCredit,
            'groupByItems' => $groupByItems,
            'getMonth' => Calendar::getMonth(),
            'getYear' => Calendar::getYear(),
            'thisYear' => $carbon->format('Y'),
            'items' => $items,
            'expense_sum' => $expense_sum,
            'income_sum' => $income_sum,
            'totalPrice' => $income_sum + $expense_sum,
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

        $val = $req->all();
        unset($val['_token']);

        unset($req['_token']);
        $nextNo = Item::max('book_no') + 1;

        // dump($req->request);
        // dd($val);

        foreach ($req->debit_credit as $k => $v) {
            $dbItem = new Item();

            $dbItem->user_id = $user_id;
            $dbItem->book_no = $nextNo;
            $dbItem->debit_credit = $v;
            $dbItem->date = $req->date;
            $dbItem->category_id = $req->category_id[$k];

            if ($req->kubun_id[$k] == 0) {
                $dbItem->kubun_id = null;
            } else {
                $dbItem->kubun_id = $req->kubun_id[$k];
            }

            if ($req->inputAccount == 'new') {
                    $dbItem->price = $req->price[$k];
                    $dbItem->comment = $req->comment;
            } else {
                    $dbItem->price = $req->price;
                    $dbItem->comment = $req->comment;
            }
            $dbItem->save();
        }

        return back();
    }

    public function showAjax(Request $req)
    {
        $user_id = Auth::id();

        $select = ['items.id','items.user_id','items.book_no','items.date','debit_credit','items.category_id','c.category_name','items.kubun_id','k.kubun_name','items.price','items.comment','c.account_type',];

        $items = Item::select($select)->join('category as c','items.category_id','c.id')->leftjoin('kubun as k','items.kubun_id','k.id')->where('user_id', $user_id)->where('book_no', (int)$req->book_no)->get();

        return $items;
    }

    public function edit(Request $req)
    {
        $user_id = Auth::id();

        $items = Item::where('user_id', $user_id)->where('book_no', (int)$req->book_no)->get();
        return view('/items/detail', ['items'=>$items]);
    }

    public function update(Request $req)
    {
        if($req->submit == 'Update') {
            $val = $req->all();
            unset($val['_token']);

            // dump($val);

            foreach($req->id as $k=>$v) {
                // $dbItem = new Item();
                $dbItem = Item::find($v);

                $dbItem->date = $val['date'];
                $dbItem->debit_credit = $val['debit_credit'][$k];
                $dbItem->category_id = $val['category_id'][$k];
                if ($req->kubun_id[$k]  == 0) {
                    $dbItem->kubun_id = null;
                } else {
                    $dbItem->kubun_id = $val['kubun_id'][$k];
                }
                $dbItem->price = $val['price'][$k];
                $dbItem->comment = $val['comment'];

                $dbItem->update();
            }
            return back();
        } elseif ($req->submit == 'Delete') {
            foreach($req->id as $v) {
                Item::find($v)->delete();
            }
            return back();
        }
    }

    public function destroy(Request $req)
    {
        //
    }
}
