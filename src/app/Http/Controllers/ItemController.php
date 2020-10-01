<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $a_id = Auth::id();

        $item = Item::where('user_id', $a_id);

        $count = $item->union('book_no')->count();

        $param = ['items' => $item, 'count' => $count,];
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
