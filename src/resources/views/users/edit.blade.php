@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{ __('Edit User Data') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="post" action="{{ route('users/edit_check') }}">
        @csrf

        <div class="form-group row">
            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            {{-- ユーザーネーム --}}
            <div class="col-md-6">
                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ Auth::user()->user_name }}" required autocomplete="user_name" autofocus>

                @error('user_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- 誕生日 --}}
        <div class="form-group row">
            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

            <div class="col-md-6">
                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ Auth::user()->birthday }}" required autocomplete="birthday">

                @error('birthday')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Update') }}" class="mr-3 btn btn-info">

            <a href="{{ url('users/show') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </form>


</div>

@endsection
