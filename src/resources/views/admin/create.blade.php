@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Admin Page')}}</div>

<div class="card-body">
    <div class="create">
        <form action="{{ route('admin/store') }}" method="post" class="">
            @csrf
            <div class="checkbox mb-3">
                <input type="radio" value="1" name="createSelect" class="mr-1" id="createSelect1" checked>
                <label for="createSelect1" class="form-check-label mr-3">科目のみ作成する</label>

                <input type="radio" value="2" name="createSelect" class="mr-1" id="createSelect2">
                <label for="createSelect2" class="form-check-label mr-3">小科目も作成する</label>

                <input type="radio" value="3" name="createSelect" class="mr-1" id="createSelect3">
                <label for="createSelect3" class="form-check-label">小科目のみ作成する</label>
            </div>

            <div class="category mb-3">
                <div class="accountType mr-3">
                    <label for="accountType">科目区分</label>
                    <select name="account_type" id="accountType" class="form-control" required>
                        <option value="" id="accountType0">---</option>
                        @foreach ($accountType as $k => $v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="createCategory">
                    <label for="createCategory">科目名</label>
                    <input type="text" name="category" id="createCategory" class="form-control " value="" required>
                </div>

                <div class="selectCategory mr-3">
                    <label for="selectCategory">科目名</label>
                    <select name="account_type" id="selectCategory" class="form-control" disabled>
                        <option value="" id="selectCategory0" selected>選択してください</option>
                    </select>
                </div>
            </div>

            <div class="kubunName mb-4">
                <label for="kubunName">小科目名</label>
                <input type="text" name="category" id="kubunName" class="form-control" value="" disabled required>
            </div>

            <div class="col-md-10">
                <input type="submit" name="" id="submit" class="btn btn-info mr-2">
                <a href="{{ route('admin/index') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
            </div>
        </form>
    </div>



</div>

@endsection
