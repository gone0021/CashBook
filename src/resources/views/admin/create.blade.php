@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Admin Page')}}</div>

<div class="card-body">
    <div class="create">
        <form action="{{ route('admin/store') }}" method="post" class="">
            @csrf
            <div class="checkbox mb-3">
                <input type="radio" value="1" name="mode" class="mr-1" id="createSelect1" checked>
                <label for="createSelect1" class="form-check-label mr-3">科目のみ作成</label>

                <input type="radio" value="2" name="mode" class="mr-1" id="createSelect2">
                <label for="createSelect2" class="form-check-label mr-3">小科目のみ作成</label>
            </div>

            <div class="crateCategory mb-3">
                <div class="createAccountType mr-3">
                    <label for="createAccountType">科目区分</label>
                    <select name="account_type" id="createAccountType" class="form-control" required>
                        <option id="option0">---</option>
                        @foreach ($accountType as $k => $v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- 科目のみ --}}
                <div class="createCategory">
                    <label for="createCategory">科目名</label>
                    <input type="text" name="category_name" id="createCategory" class="form-control " value="" required>
                </div>

                {{-- 小科目を含む場合 --}}
                <div class="createSelectCategory mr-3">
                    <label for="createSelectCategory">科目名</label>
                    <select name="category_id" id="createSelectCategory" class="form-control" disabled>
                        <option value="" id="option1" selected>選択してください</option>
                    </select>
                </div>
            </div>

            <div class="createKubunName mb-4">
                <label for="createKubunName">小科目名</label>
                <input type="text" name="kubun_name" id="createKubunName" class="form-control" value="" disabled required>
            </div>

            <div class="col-md-10">
                <input type="submit" name="" id="submit" class="btn btn-info mr-2" value="{{ __('New') }}">
                <a href="{{ route('admin/index') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
            </div>
        </form>
    </div>



</div>

@endsection
