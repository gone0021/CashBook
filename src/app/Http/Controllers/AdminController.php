<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Kubun;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        return view('/admin/index');
    }

    public function show(Request $req)
    {
        return view('/admin/show');
    }

    public function create(Request $req)
    {
        $accountType = $this->accountType();

        dump($accountType);
        $param = [
            'accountType' => $accountType,
        ];

        return view('/admin/create', $param);
    }

    public function store(Request $req)
    {
        //
    }

    public function edit(Request $req)
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

    public function accountType()
    {
        $type = array('資産', '費用', '収入',);
        return $type;
    }
}
