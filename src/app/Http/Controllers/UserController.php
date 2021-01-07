<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\helpers;

class UserController extends Controller
{
    /**
     * ユーザーページ
     *
     * @return void
     */
    public function index()
    {
        return view('/users.index');
    }

    /**
     * ユーザー情報の確認
     *
     * @return void
     */
    public function show()
    {
        $item = User::find(Auth::id());
        $param = ['item' => $item];
        return view('/users.show', $param);
    }

    /**
     * ユーザー情報の編集
     *
     * @return void
     */
    public function edit()
    {
        return view('/users.edit');
    }

    /**
     * ユーザー情報の編集：確認画面
     *
     * @return void
     */
    public function editCheck(UserRequest $req)
    {
        $param = $req->all();
        unset($param['_token']);
        return view('/users.edit_check', $param);
    }

    /**
     * ユーザー情報の編集：実行
     *
     * @return void
     */
    public function update(Request $req)
    {
        $val = $req->all();
        unset($val['_token']);

        $user = User::find(Auth::id());
        $user->fill($val)->update();

        return redirect('/users/done');
    }

    /**
     * パスワードの変更・削除
     *
     * @return void
     */
    public function account()
    {
        $param = ['id' =>  Auth::id()];
        return view('/users.account', $param);
    }

    /**
     * パスワードの変更
     *
     * @return void
     */
    public function password()
    {
        return view('/users.password');
    }

    /**
     * パスワードの変更：実行
     *
     * @return void
     */
    public function passwordUpdate(UserRequest $req)
    {
        $pass = Hash::make($req->password);

        $user = User::find(Auth::id());
        $user->password = $pass;
        $user->update();
        return redirect('/users/password/done');
    }

    /**
     * ユーザーの削除
     *
     * @return void
     */
    public function delete()
    {
        return view('/users.delete');
    }

    /**
     * パスワードによる確認
     *
     * @return void
     */
    public function fort()
    {
        return view('/users.fort');
    }

    /**
     * ユーザーの削除：実行
     *
     * @return void
     */
    public function destroy(UserRequest $req)
    {
        if (!helpers::checkUserId($req->user_id)) {
            Auth::logout();
            return view('welcome');
        } else {
            User::find($req->user_id)->delete();
            Auth::logout();
            return redirect('/users/delete/done');
        }
    }
}
