@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Admin Page')}}</div>

<div class="card-body">

    <p>
        <a href=" {{ route('admin/create') }} ">
            科目の追加
        </a>
    </p>

    <p>
        <a href=" {{ route('admin/edit') }} ">
            科目の編集・削除
        </a>
    </p>

    <div class="col-md-10">
        <a href="{{ route('home') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
