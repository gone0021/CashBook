@extends('layouts.cardapp')

@section('card')

<div class="card-header">{{ __('Edit Paassword') }}</div>


<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="post" action="{{ route('users/password_check') }}">
        @csrf

        {{-- 元パスワード --}}
        <div class="form-group row">
            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

            <div class="col-md-6">
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="new-password">

                @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>


        {{-- 新パスワード --}}
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- 新パスワードチェック --}}
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Update') }}" class="mr-3 btn btn-info">

            <a href="{{ route('users') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </form>
</div>
@endsection
