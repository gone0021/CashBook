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
        $kubun = Kubun::where('category_id', $req->id)->get();
        return $kubun;

    }
}
