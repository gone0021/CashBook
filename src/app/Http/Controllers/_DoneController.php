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
        $link =  route('users');
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
        $link =  route('users');
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

    /**
     * グループの脱退
     *
     * @return void
     */
    public function usersLeave()
    {
        $title = __(' Leave Group Completed');
        $msg = '脱退が完了しました';
        $link =  route('users');
        $disp = 'Home';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * グループの作成
     *
     * @return void
     */
    public function adminCreate()
    {
        $title = __(' New Group Completed');
        $msg = '登録が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * グループの編集
     *
     * @return void
     */
    public function adminEdit()
    {
        $title = __(' Edit Group Completed');
        $msg = '更新が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * グループ管理者の追加
     *
     * @return void
     */
    public function adminGroupAdminAdd()
    {
        $title = __(' Add Admin Completed');
        $msg = '登録が完了しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * グループの削除
     *
     * @return void
     */
    public function adminDelete()
    {
        $title = __(' Derlete Group Completed');
        $msg = 'グループを削除しました';
        $link =  route('admin');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * ユーザーの追加
     *
     * @return void
     */
    public function groupAddUser()
    {
        $title = __(' Add User Completed');
        $msg = 'ユーザーを追加しました';
        $link =  route('group');
        $disp = '管理者ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * tripsの新規作成
     *
     * @return void
     */
    public function tripNew()
    {
        $title = __(' New Trip Item');
        $msg = '登録が完了しました';
        $link =  route('trips');
        $disp = '場所ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }


    /**
     * tripsの編集
     *
     * @return void
     */
    public function tripEdit()
    {
        $title = __(' Edit Trip Item');
        $msg = '更新が完了しました';
        $link =  route('trips');
        $disp = '場所ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * tripsの削除
     *
     * @return void
     */
    public function tripDelete()
    {
        $title = __(' Delete Trip Item');
        $msg = '削除が完了しました';
        $link =  route('trips');
        $disp = '場所ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }



    /**
     * plansの新規作成
     *
     * @return void
     */
    public function planNew()
    {
        $title = __(' New Trip Item');
        $msg = '登録が完了しました';
        $link =  route('plans');
        $disp = '予定ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * plansの編集
     *
     * @return void
     */
    public function planEdit()
    {
        $title = __(' Edit Trip Item');
        $msg = '更新が完了しました';
        $link =  route('plans');
        $disp = '予定ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * plansの削除
     *
     * @return void
     */
    public function planDelete()
    {
        $title = __(' Delete Trip Item');
        $msg = '削除が完了しました';
        $link =  route('plans');
        $disp = '予定ページ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }


    /**
     * plansの新規作成
     *
     * @return void
     */
    public function divelogNew()
    {
        $title = __(' New Dive Log');
        $msg = '登録が完了しました';
        $link =  route('divelogs');
        $disp = 'ダイブログ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }


    /**
     * divelogsの編集
     *
     * @return void
     */
    public function divelogEdit()
    {
        $title = __(' Edit Dive Log');
        $msg = '更新が完了しました';
        $link =  route('divelogs');
        $disp = 'ダイブログ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

    /**
     * divelogsの削除
     *
     * @return void
     */
    public function divelogDelete()
    {
        $title = __(' Delete Dive Log');
        $msg = '削除が完了しました';
        $link =  route('divelogs');
        $disp = 'ダイブログ';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }

}
