@extends('layouts.cardapp')

@section('card')

<div class="card-header">{{ __('User Data') }}</div>

<div class="card-body">
    <table class="table table-hover col-md-10 offset-md-1">
        <tr class="">
            <th class="">ユーザー名</th>
            <td class="">{{ $item->user_name }}</td>
        </tr>

        <tr>
            <th class="">メールアドレス</th>
            <td class="">{{ $item->email }}</td>
        </tr>

        <tr>
            <th class="">誕生日</th>
            <td class="">{{ $item->birthday }}</td>
        </tr>
    </table>

    <div class="col-md-10 offset-md-2">
        <a href="{{ route('users/edit') }}" class="mr-3 btn btn-info">
            {{ __('Edit') }}
        </a>
        <a href="{{ route('users') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>
</div>

@endsection
