@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{ __('Paassword Confirmation') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="post" action="{{ route('users/destroy') }}">
        @csrf

        {{-- 元パスワード --}}
        <div class="form-group row">
            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="new-password">

                @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                {{-- 現在のid --}}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Do') }}" class="mr-3 btn btn-light">

            <a href="{{ route('users') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </form>

</div>

@endsection
