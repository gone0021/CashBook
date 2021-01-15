<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Kubun;
use Carbon\Carbon;

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
        $nextNo = Item::max('book_no') + 1;
        // dump($nextNo);
        $carbon = new Carbon('now');
        $today = $carbon->format('Y-m-d');

        // modal用
        $categoryAccet = Category::where('account_type', 0)->get();
        $categoryCost = Category::where('account_type', 1)->get();
        $categoryProfit = Category::where('account_type', 2)->get();

        $categoryAll = Category::all();
        $kubun = Kubun::all();

        $param = [
            'today' => $today,
            'categoryAll' => $categoryAll,
            'categoryAccet' => $categoryAccet,
            'categoryCost' => $categoryCost,
            'categoryProfit' => $categoryProfit,
            'kubun' => $kubun,
        ];
        return view('home', $param);
    }
}
