<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Kubun;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        return view('/admin/index');
    }

    public function show(Request $req)
    {
        //
    }

    public function create(Request $req)
    {
        $param = [
            'accountType' => $this->accountType(),
        ];

        return view('/admin/create', $param);
    }

    public function store(Request $req)
    {
        if ($req->mode == 1) {  // category
            $validator = Validator::make($req->all(), Category::$ruleCreate, Category::$msgCreate);
            if ($validator->fails()) {
                $param = ['validateMsg' => 'createCategory'];
                return redirect('/admin/create')->withErrors($validator)->with($param)->withInput();
            } else {
                $val = $req->all();
                unset($val['_token']);

                $dbCategory = new Category();
                $dbCategory->fill($val)->save();
            }
        } else {  // kubun
            $validator = Validator::make($req->all(), Kubun::$ruleCreate, Kubun::$msgCreate);
            if ($validator->fails()) {
                $param = ['validateMsg' => 'createKubun'];
                return redirect('/admin/create')->withErrors($validator)->with($param)->withInput();
            } else {
                $val = $req->all();
                unset($val['account_type']);
                unset($val['_token']);

                $dbKubun = new Kubun();
                $dbKubun->fill($val)->save();
            }
        }
        // return back();
        return redirect('/admin/create');
    }

    public function edit(Request $req)
    {
        $accountType = $this->accountType();
        $param = [
            'accountType' => $accountType,
        ];

        return view('/admin/edit', $param);
    }

    public function update(Request $req)
    {
        if ($req->mode == 1 || $req->mode == 3) {  // category
            $id = $req->category_id;

            if ($req->submit == 'Update') {
                $validator = Validator::make($req->all(), Category::$ruleEdit, Category::$msgEdit);

                if ($validator->fails()) {
                    $param = ['validateMsg' => 'editCategory'];
                    return redirect('/admin/edit')->withErrors($validator)->with($param)->withInput();
                } else {
                    $dbCategory = Category::find($id);
                    $dbCategory->category_name = $req->category_name;
                    $dbCategory->update();
                }
            } elseif ($req->submit == 'Delete') {
                $validator = Validator::make($req->all(), Category::$ruleDel, Category::$msgDel);
                if ($validator->fails()) {
                    $param = ['validateMsg' => 'editCategoryDel'];
                    return redirect('/admin/edit')->withErrors($validator)->with($param)->withInput();
                } else {
                    Category::find($id)->delete();
                }
            }
        } elseif ($req->mode == 2 || $req->mode == 4) {  // kubun
            $id = $req->kubun_id;
            $val = $req->all();
            unset($val['_token']);
            unset($val['submit']);
            unset($val['mode']);
            unset($val['kubun_id']);
            unset($val['account_type']);
            if ($req->submit == 'Update') {
                $validator = Validator::make($req->all(), Kubun::$ruleEdit, Kubun::$msgEdit);

                if ($validator->fails()) {
                    $param = ['validateMsg' => 'editKubun'];
                    return redirect('/admin/edit')->withErrors($validator)->with($param)->withInput();
                } else {
                    if ($id == 0) {
                        $dbKubun = new Kubun();
                        $dbKubun->fill($val)->save();
                    } else {
                        Kubun::find($id)->fill($val)->update();
                    }
                }
            } elseif ($req->submit == 'Delete') {
                $validator = Validator::make($req->all(), Kubun::$ruleDel, Kubun::$msgDel);
                if ($validator->fails()) {
                    $param = ['validateMsg' => 'editKubunDel'];
                    return redirect('/admin/edit')->withErrors($validator)->with($param)->withInput();
                } else {
                    if ($id == 0) {
                        return redirect('/admin/edit');
                    } else {
                        Kubun::find($id)->delete();
                    }
                }
            }
        }
        return redirect('/admin/edit');

        dd($val);
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
