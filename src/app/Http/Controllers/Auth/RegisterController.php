<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // フォームリクエストでバリデーションを記述
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // 以下より独自メソッド

    /**
     * 新規登録の確認
     *
     * @param UserRequest $req
     * @return void
     */
    public function registerCheck(UserRequest $req)
    {
        $val = $req->all();
        unset($val['_token']);
        unset($val['password_confirmation']);

        $param = $val;
        return view('/auth.register_check', $param,);
    }

    /**
     * 新規登録の実行
     *
     * @param Request $req
     * @return void
     */
    public function registerAdd(Request $req)
    {
        $users = new User;
        $val = $req->all();
        $val['password'] = Hash::make($val['password']);
        unset($val['_token']);
        // dump($val); die;

        $users->fill($val)->save();
        return redirect('/register_done');
    }

    /**
     * 登録完了
     *
     * @return void
     */
    public function registerDone()
    {
        $title = __('Register Completed');
        $msg = '登録が完了しました';
        $link =  route('login');
        $disp = 'Login';

        $param = ['title' => $title, 'msg' => $msg, 'link' => $link, 'disp' => $disp];
        return view('/done', $param);
    }
}
