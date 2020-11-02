@extends('layouts.cardapp')
@section('card')

<div class="card-header">Home</div>

<div class="card-body">
    <div class="mb-3">
        <a href="{{ route('users/account') }}">
            アカウント設定
        </a>
    </div>

    @if (Auth::user()->is_admin == '1')
    <div class="mb-3">
        <a href="{{ route('admin') }}">
            管理者画面
        </a>
    </div>
    @endif

    <p>
        <a href="{{ url('calendar') }}">
            カレンダー表示
        </a>
    </p>

    <div class="mb-3">
        <div class="my-2">● 新規作成</div>
        <div class="btn btn-sticky mx-2 mb-3" id="newAccount">
            簿記風
        </div>

        <div class="ml-2">
            <div class="btn btn-sticky mr-2" id="newExpense">
                支出のみ
            </div>

            <div class="btn btn-sticky" id="newIncome">
                収入のみ
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div>● 収支一覧</div>
        <div class="my-2 ml-2">
            <a href="{{ route('items/index') }}" class="btn btn-sticky mb-2" id="btNewAccounting">
                家計簿一覧
            </a>
        </div>

        <div class="ml-2">
            <a href="" class="btn btn-sticky" id="btNewAccounting">
                月別
            </a>
        </div>
    </div>

    <div class="">
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


    {{-- @include('name') --}}
    <div class='glayLayer'></div>
    {{-- @include('components.expense_modal') --}}
    @component ('components.account_modal')
    @slot('today',$today)
    @slot('categoryAll',$categoryAll)
    @endcomponent

    @component ('components.expense_modal')
    @slot('today',$today)
    @slot('categoryAccet',$categoryAccet)
    @slot('categoryCost',$categoryCost)
    @endcomponent

    @component ('components.income_modal')
    @slot('today',$today)
    @slot('categoryAccet',$categoryAccet)
    @slot('categoryprofit',$categoryprofit)
    @endcomponent


    @endsection
