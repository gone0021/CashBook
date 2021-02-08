@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{ __('User Setting') }}</div>

<div class="card-body">
    <p>
        <a href="{{ route('users/show') }}">
            ユーザー情報
        </a>
    </p>
    <p>
        <a href="{{ route('users/password') }}">
            パスワードの変更
        </a>
    </p>

    <p>
        <a href="{{ route('users/delete') }}">
            アカウントの削除
        </a>
    </p>

    <div class="col-md-10">

        <a href="{{ route('home') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>
</div>
@endsection
