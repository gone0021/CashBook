@extends('layouts.app')
@section('content')

@parent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                @yield('card')
            </div>
        </div>
    </div>
</div>
@endsection
