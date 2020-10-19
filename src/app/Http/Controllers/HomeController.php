<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Kubun;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nextNo = Item::getBookNo() + 1;
        dump($nextNo);

        // modal用
        $categoryAccet = Category::where('account_type',1)->get();
        $categoryCost = Category::where('account_type',2)->get();
        $categoryprofit = Category::where('account_type',3)->get();

        $categoryAll = Category::all();
        $kubun = Kubun::all();

        $param = [
            'categoryAll' => $categoryAll,
            'categoryAccet' => $categoryAccet,
            'categoryCost' => $categoryCost,
            'categoryprofit' => $categoryprofit,
            'kubun' => $kubun,
        ];
        return view('home', $param);
    }


}
