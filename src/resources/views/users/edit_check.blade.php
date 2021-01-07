@extends('layouts.cardapp')

@section('card')

<div class="card-header">{{ __('Check Edit') }}</div>

<div class="card-body">
    {{-- <form method="POST" action="{{ route('register') }}"> --}}
    <form method="POST" action="{{ route('users/update') }}">
        @csrf

        {{-- ユーザーネーム --}}
        <div class="form-group row">
            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-4 mt-2 mb-0">
                <span>{{ $user_name }}</span>

                <input id="user_name" type="hidden" class="form-control @error('user_name') is-invalid @enderror"
                    name="user_name" value="{{ $user_name }}" required autocomplete="user_name" autofocus>

            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-4 mt-2">
                <span>{{ $email }}</span>
                <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $email }}" required autocomplete="email">

            </div>
        </div>

        {{-- 誕生日 --}}
        <div class="form-group row">
            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

            <div class="col-md-6 mt-2">
                <span>{{ $birthday }}</span>
                <input id="birthday" type="hidden" class="form-control @error('email') is-invalid @enderror"
                    name="birthday" value="{{ $birthday }}" required autocomplete="birthday">

            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-10 offset-md-2">
                <button type="submit" class="btn btn-info mr-3">
                    {{ __('Done') }}
                </button>
                <a href="{{ url('users/edit') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
