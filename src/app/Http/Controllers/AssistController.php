<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ------
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;

class AssistController extends Controller
{

    /**
     * パスワード忘れページ
     *
     * @param Request $req
     * @return void
     */
    public function forgetPass()
    {
        return view('/assist.forget_pass');
    }


    /**
     * メールアドレスと誕生日からユーザーをチェック
     *
     * @param Request $req
     * @return void
     */
    public function resetPass(Request $req)
    {
        $this->validate($req, User::$rules, User::$messages);

        $user = new User;
        $email = $user->where('email', $req->email)->first();

        // sessionにidを保存
        $req->session()->put('id', $email->id);

        $ses_get = session()->get('id');
        dump($ses_get);

        if(empty($email->birthday)) {
            $msg = ['msg' => '登録が見つかりません'];
            return view('/assist.forget_pass', $msg);
        }
        elseif($email->birthday !== $req->birthday ) {
            $msg = ['msg' => '情報が一致しません'];
            return view('/assist.forget_pass', $msg);
        } else {
            return view('/assist.reset_pass');
        }
    }

    /**
     * パスワードのリセット
     *
     * @return void
     */
    public function passAction(UserRequest $req)
    {
        $ses_get = session()->get('id');

        // dump($ses_get);
        // dump($req->password);
        // return view('test');

        $pass = Hash::make($req->password);

        $user = User::find($ses_get);
        $user->password = $pass;
        $user->update();
        return redirect('/pass_done');
    }
}
