<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Category;
use App\Models\Kubun;

class AjaxController extends Controller
{
    public function getCategory(Request $req)
    {
        $kubun = Category::all();
        return $kubun;
    }

    public function getKubun(Request $req)
    {
        $kubun = Kubun::all();
        return $kubun;
    }

    public function getCategoryByAccountType(Request $req)
    {
        $kubun = Category::where('account_type', $req->account_type)->get();
        return $kubun;
    }

    public function getCategoryIncome(Request $req)
    {
        $kubun = Category::where('account_type', 2)->get();
        return $kubun;
    }

    public function getCategoryExpense(Request $req)
    {
        $kubun = Category::where('account_type', 1)->get();
        return $kubun;
    }

    public function getKubunByCategoryId(Request $req)
    {
        $kubun = Kubun::where('category_id', $req->category_id)->get();
        return $kubun;
    }

    public function getKubunByCategoryIdGet(Request $req)
    {
        $kubun = Kubun::where('category_id', $req->category_id)->get();
        return $kubun;
    }
}
