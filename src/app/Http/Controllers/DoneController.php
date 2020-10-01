<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoneController extends Controller
{
    /**
     * パスワードの忘れ
     *
     * @return void
     */
    public function forgetPass()
    {
        $title = __(' Edit Password Completed');
        $msg = 'パスワードを変更しました';
        $link =  route('login');
        $disp = 'login';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * ユーザー情報の編集
     *
     * @return void
     */
    public function usersEdit()
    {
        $title = __(' Edit Completed');
        $msg = '編集が完了しました';
        $link =  route('home');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * パスワードの変更
     *
     * @return void
     */
    public function usersPassword()
    {
        $title = __(' Edit Password Completed');
        $msg = 'パスワードを変更しました';
        $link =  route('home');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * ユーザーの削除
     *
     * @return void
     */
    public function usersDelete()
    {
        $title = __(' Delete Account Completed');
        $msg = 'アカウントを削除しました';
        $link =  url('/');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }
}
