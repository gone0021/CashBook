<div id="detailNomal">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="mb-3">
            {{-- <input type="text" name="" id="bookNo" value="" disabled> --}}
            <label for="detailNomalBookNo">book No.</label>
            <span id="detailNomalBookNo" class="mr-3"></span>

            <label for="detailNomalDate" class="">日付：</label>
            <div class="detailNomalinputDate">
                <input type="date" name="date" id="detailNomalDate" class="form-control" value="" disabled required>
            </div>
        </div>

        <div class="detailNomalDiv0">
            <input type="hidden" name="debit_credit[]" id="debit_credit0" value="">
            <div class="detailNomalCategory0">
                <label for="detailNomalCategory0">収支：</label>
                <select name="category_id[]" id="detailNomalCategory0" class="form-control" disabled required>
                </select>
            </div>

            <div class="detailNomalKubun0">
                <label for="detailNomalKubun0">小区分：</label>
                <select name="kubun_id[]" id="detailNomalKubun0" class="form-control" disabled required>
                </select>
            </div>
        </div>

        <div class="detailNomalDiv1">
            <input type="hidden" name="debit_credit[]" id="debit_credit1" value="">
            <div class="detailNomalCategory1">
                <label for="detailNomalCategory1">内容：</label>
                <select name="category_id[]" id="detailNomalCategory1" class="form-control" disabled required>
                </select>
            </div>

            <div class="detailNomalKubun1">
                <label for="detailNomalKubun1">小区分：</label>
                <select name="kubun_id[]" id="detailNomalKubun1" class="form-control" disabled required>
                </select>
            </div>
        </div>

        <div class="detailNomalPrice">
            <label for="detailNomalPrice" class="">金額：</label>
            <div class="detailNomalinputPrice">
                <input type="text" name="price" id="detailNomalPrice" class="form-control" value=""  disabled required>
            </div>
        </div>

        <div class="detailNomalLast">
            <div class="detailNomalCommentSubmit">
                <label for="detailNomalComment" class="detailNomalCommentLabel">コメント：</label>
                <div class="detailNomalinputComment">
                    <textarea name="comment" id="detailNomalComment" class="form-control" cols="36"
                        rows="5" disabled>
                    </textarea>
                </div>
                <div class="detailNomalSubmit">
                    <input type="submit" name="" value="new" class="btn btn-info">
                </div>
            </div>
        </div>

    </form>
</div>
