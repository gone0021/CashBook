<div id="detailNomal">
    <form action="{{ route('items/update') }}" method="POST">
        @csrf
        <div class="mb-3">
            {{-- <input type="text" name="" id="bookNo" value="" disabled> --}}
            <span>book No.</span>
            <span id="detailNomalBookNo" class="mr-3"></span>

            <label for="detailNomalDate" class="">日付：</label>
            <div class="detailNomalinputDate">
                <input type="date" name="date" id="detailNomalDate" class="form-control" value="" disabled required>
            </div>
        </div>

        <div class="detailNomalDiv0">
            <input type="hidden" name="id[]" value="" id="detailNomalId0">
            <input type="hidden" name="debit_credit[]" id="detailNomalDc0" value="">

            <div class="detailNomalCategory0">
                <label for="detailNomalCategory0">収支：</label>
                <select name="category_id[]" id="detailNomalCategory0" class="form-control" disabled required>
                </select>
            </div>

            <div class="detailNomalKubun0">
                <label for="detailNomalKubun0">小科目：</label>
                <select name="kubun_id[]" id="detailNomalKubun0" class="form-control" disabled required>
                </select>
            </div>
        </div>

        <div class="detailNomalDiv1">
            <input type="hidden" name="id[]" value="" id="detailNomalId1">
            <input type="hidden" name="debit_credit[]" id="detailNomalDc1" value="">

            <div class="detailNomalCategory1">
                <label for="detailNomalCategory1">内容：</label>
                <select name="category_id[]" id="detailNomalCategory1" class="form-control" disabled required>
                </select>
            </div>

            <div class="detailNomalKubun1">
                <label for="detailNomalKubun1">小科目：</label>
                <select name="kubun_id[]" id="detailNomalKubun1" class="form-control" disabled required>
                </select>
            </div>
        </div>

        <div class="detailNomalPrice">
            <label for="detailNomalPrice0" class="">金額：</label>
            <div class="detailNomalinputPrice">
                <input type="text" name="price[]" id="detailNomalPrice0" class="form-control" value="" disabled required>
                <input type="hidden" name="price[]" id="detailNomalPrice1" class="form-control" value="" disabled required>
            </div>
        </div>

        <div class="detailNomalComment mb-3">
            <div class="detailNomalCommentSubmit">
                <label for="detailNomalComment" class="detailNomalCommentLabel">コメント：</label>
                <div class="detailNomalinputComment">
                    <textarea name="comment" id="detailNomalComment" class="form-control" cols="36"
                        rows="5" disabled>
                    </textarea>
                </div>
            </div>
        </div>
        <div class="detailNomalBtn col-md-10">
            <button id="detaliNomalEdit" class="btn btn-info btnEdit mr-3">{{ __('Edit') }}</button>
            <input type="submit" name="submit" id="detailNomalUpdate" class="btn btn-info btnUpdate mr-3" value="{{ __('Update') }}" disabled>
            <input type="submit" name="submit" id="detailNomalDel" class="btn btn-outline-danger btnDel mr-3" value="{{ __('Delete') }}">
        </div>
    </form>
</div>
