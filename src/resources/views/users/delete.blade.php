@extends('layouts.cardapp')
@section('card')


<div class="card-header">{{ __('Delte Account') }}</div>

<div class="card-body">
    <p class="text-md-center lead">
        {{ __('Do you really want to delete it?') }}
    </p>
    <div class="text-md-center lead">
        <div class="col-md-10">
            <a href="{{ route('users/fort') }}" class="btn btn-light mr-3">
                {{ __('Delete') }}
            </a>

            <a href="{{ route('users/account') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </div>
</div>

@endsection
