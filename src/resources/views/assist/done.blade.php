@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{ $title }}</div>

<div class="card-body">
    <p class="text-md-center lead">{{ $msg }}</p>

    <div class="text-md-center lead">
        <a href="{{ $link }}">{{ $disp }}</a>
    </div>
</div>

@endsection
