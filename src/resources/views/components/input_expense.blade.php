<div id="inputExpense">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="inputExpenseDate">
            <label for="inputExpenseDate" class="">日付：</label>
            <div class="inputExpenseinputDate">
                <input type="date" name="date" id="inputExpenseDate" class="form-control" value="{{ $today }}" required>
            </div>
        </div>

        <div class="inputExpenseAsset">
            <input type="hidden" name="debit_credit[]" id="" value="2">
            <div class="inputExpenseAssetCategory">
                <label for="inputExpenseAssetCategory">支出：</label>
                <select name="category_id[]" id="inputExpenseAssetCategory" class="form-control">
                    <option value="" class="selectFormatExpenseAccet" required>選択してください</option>
                    @foreach ($categoryAccet as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputExpenseAssetKubun">
                <label for="inputExpenseAssetKubun">小区分：</label>
                <select name="kubun_id[]" id="inputExpenseAssetKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="inputExpenseCost">
            <input type="hidden" name="debit_credit[]" id="" value="1">
            <div class="inputExpenseCostCategory">
                <label for="inputExpenseCostCategory">内容：</label>
                <select name="category_id[]" id="inputExpenseCostCategory" class="form-control" required>
                    <option value="" class="selectFormatExpenseCost">選択してください</option>
                    @foreach ($categoryCost as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputExpenseCostKubun">
                <label for="inputExpenseCostKubun">小区分：</label>
                <select name="kubun_id[]" id="inputExpenseCostKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="inputExpensePrice">
            <label for="inputExpensePrice" class="">金額：</label>
            <div class="inputExpenseinputPrice">
                <input type="text" name="price" id="inputExpensePrice" class="form-control" value="" required>
            </div>
        </div>

        <div class="inputExpenseLast">
            <div class="inputExpenseCommentSubmit">
                <label for="inputExpenseComment" class="inputExpenseCommentLabel">コメント：</label>
                <div class="inputExpenseinputComment">
                    <textarea name="comment" id="inputExpenseComment" class="form-control" cols="36"
                        rows="5"></textarea>
                </div>
                <div class="inputExpenseSubmit">
                    <input type="submit" name="inputExpense" id="inputExpenseNew" value="new" class="btn btn-info">
                </div>
            </div>
        </div>

    </form>
</div>
