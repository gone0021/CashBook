<div id="expenseModal">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="expenseModalDate">
            <label for="expenseModalDate" class="">日付：</label>
            <div class="expenseModalinputDate">
                <input type="date" name="date" id="expenseModalDate" class="form-control" value="{{ $today }}" required>
            </div>
        </div>

        <div class="expenseModalAsset">
            <input type="hidden" name="debit_credit[]" id="" value="2">
            <div class="expenseModalAssetCategory">
                <label for="expenseModalAssetCategory">支払：</label>
                <select name="category_id[]" id="expenseModalAssetCategory" class="form-control">
                    <option value="" class="selectFormatExpenseAccet" required>選択してください</option>
                    @foreach ($categoryAccet as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="expenseModalAssetKubun">
                <label for="expenseModalAssetKubun">小区分：</label>
                <select name="kubun_id[]" id="expenseModalAssetKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="expenseModalCost">
            <input type="hidden" name="debit_credit[]" id="" value="1">
            <div class="expenseModalCostCategory">
                <label for="expenseModalCostCategory">内容：</label>
                <select name="category_id[]" id="expenseModalCostCategory" class="form-control" required>
                    <option value="" class="selectFormatExpenseCost">選択してください</option>
                    @foreach ($categoryCost as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="expenseModalCostKubun">
                <label for="expenseModalCostKubun">小区分：</label>
                <select name="kubun_id[]" id="expenseModalCostKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="expenseModalPrice">
            <label for="expenseModalPrice" class="">金額：</label>
            <div class="expenseModalinputPrice">
                <input type="text" name="price" id="expenseModalPrice" class="form-control" value="" required>
            </div>
        </div>

        <div class="expenseModalLast">
            <div class="expenseModalCommentSubmit">
                <label for="expenseModalComment" class="expenseModalCommentLabel">コメント：</label>
                <div class="expenseModalinputComment">
                    <textarea name="comment" id="expenseModalComment" class="form-control" cols="36"
                        rows="5"> {{ old('comment') }}</textarea>
                </div>
                <div class="expenseModalSubmit">
                    <input type="submit" name="" id="" value="new" class="btn btn-info">
                </div>
            </div>
        </div>

    </form>
</div>
