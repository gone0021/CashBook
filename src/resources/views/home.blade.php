@extends('layouts.cardapp')
@section('card')

<div class="card-header">Home</div>

<div class="card-body">
    <p>
        <a href="{{ route('users/account') }}">
            アカウント設定
        </a>
    </p>

    @if (Auth::user()->is_admin == '1')
    <p>
        <a href="{{ route('admin') }}">
            管理者画面
        </a>
    </p>
    @endif

    <p>
        <a href="{{ url('calendar') }}">
            カレンダー表示
        </a>
    </p>

    <div>
        <div class="my-2">● 新規作成</div>
        <a href="" class="btn btn-sticky mr-2 ml-2" id="btNewAccounting">
            簿記風
        </a>

        <a href="" class="btn btn-sticky" dir="btNnewNomal">
            支出のみ
        </a>
    </div>

    <p>
        <div>● 収支一覧</div>

        <div class="my-2 ml-2">
            <a href="" class="btn btn-sticky mb-2" id="btNewAccounting">
                家計簿一覧
            </a>
        </div>

        <div class="ml-2">
            <a href="" class="btn btn-sticky" id="btNewAccounting">
                月別
            </a>
        </div>
    </p>

    <p>
        <form action="{{ url('users/new') }}" method="GET" class="mt-1 mb-3">
            <label for="new" class="">● カテゴリ別</label>
            <br>
            <select name="new" id="new" class="mr-3 ml-3">
                {{-- categoryテーブルをforeachで読み込む --}}
                <option value="0">支出</option>
                </option>
                <option value="1">収入</option>
            </select>

            <input type="submit" name="" id="" value="new" class="btn btn-info">
        </form>
    </p>



    @endsection
