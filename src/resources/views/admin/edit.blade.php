@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Admin Page')}}</div>

<div class="card-body">
    <div class="edit">
        <form action="{{ route('admin/update') }}" method="post" class="">
            @csrf
            <div class="checkbox mb-3">
                <input type="radio" value="1" name="mode" class="mr-1" id="editSelect1" checked>
                <label for="editSelect1" class="form-check-label mr-3">科目のみ編集</label>
                <input type="radio" value="2" name="mode" class="mr-1" id="editSelect2">
                <label for="editSelect2" class="form-check-label mr-3">小科目のみ編集</label>

                <input type="radio" value="3" name="mode" class="mr-1" id="editSelect3">
                <label for="editSelect3" class="form-check-label mr-3">科目の削除</label>

                <input type="radio" value="4" name="mode" class="mr-1" id="editSelect4">
                <label for="editSelect4" class="form-check-label mr-3">小科目の削除</label>
             </div>

            <div class="editDiv mb-3">
                <div class="editAccountType mr-3">
                    <label for="editAccountType">科目区分</label>
                    <select name="account_type" id="editAccountType" class="form-control" required>
                        <option id="option0">---</option>
                        @foreach ($accountType as $k => $v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="editSelectCategory mr-3">
                    <label for="editSelectCategory">科目名</label>
                    <select name="category_id" id="editSelectCategory" class="form-control" required>
                        <option value="" id="option1" selected>選択してください</option>
                    </select>
                </div>

                <div class="editSelectKubun mr-3">
                    <label for="editSelectKubun">小科目名</label>
                    <select name="kubun_id" id="editSelectKubun" class="form-control">
                        <option value="" id="option2" selected>選択してください</option>
                    </select>
                </div>
            </div>

            <div class="editCategoryName mb-4">
                <label for="editCategoryName">変更（科目名）</label>
                <input type="text" id="editCategoryName" class="form-control"  name="category_name" value="" required>
            </div>

            <div class="editKubunName mb-4">
                <label for="editKubunName">変更名（小科目名）</label>
                <input type="text" id="editKubunName" class="form-control"  name="kubun_name" value="" disabled>
            </div>


            <div class="editAccountDel mb-4">
                <input type="submit" name="submit" id="editAccountDel" class="btn-outline-danger form-control btnDel" value="{{ __('Delete')}}" disabled>
            </div>

            <div class="editAccountUpdate col-md-10">
                <input type="submit" name="submit" id="editAccountUpdate" class="btn btn-info btnUpdate mr-3" value="{{ __('Update') }}">

                <a href="{{ route('admin/index') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
            </div>
        </form>
    </div>



</div>

@endsection
