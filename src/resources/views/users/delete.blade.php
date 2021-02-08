@extends('layouts.cardapp')
@section('card')


<div class="card-header">{{ __('Delte Account') }}</div>

<div class="card-body">
    <p class="text-md-center lead">
        {{ 'アカウントを削除してよろしいですか？' }}
    </p>
    <div class="text-md-center lead">
        <div class="col-md-10">
            <a href="{{ route('users/fort') }}" class="btn btn-outline-danger mr-3">
                {{ __('Delete') }}
            </a>

            <a href="{{ route('users') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </div>
</div>

@endsection
