<div id="inputIncome">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="inputIncomeDate">
            <label for="inputIncomeDate" class="">日付：</label>
            <div class="inputIncomeinputDate">
                <input type="date" name="date" id="inputIncomeDate" class="form-control" value="{{ $today }}" required>
            </div>
        </div>

        <div class="inputIncomeAsset">
            <input type="hidden" name="submit" value="inputIncome">
            <input type="hidden" name="debit_credit[]" id="" value="1">
            <div class="inputIncomeAssetCategory">
                <label for="inputIncomeAssetCategory">収入：</label>
                <select name="category_id[]" id="inputIncomeAssetCategory" class="form-control" required>
                    <option value="" class="selectFormatIncomeAccet">選択してください</option>
                    @foreach ($categoryAccet as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputIncomeAssetKubun">
                <label for="inputIncomeAssetKubun">小科目：</label>
                <select name="kubun_id[]" id="inputIncomeAssetKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="inputIncomePl">
            <input type="hidden" name="debit_credit[]" id="" value="2">
            <div class="inputIncomePlCategory">
                <label for="inputIncomePlCategory">内容：</label>
                <select name="category_id[]" id="inputIncomePlCategory" class="form-control" required>
                    <option value="" class="selectFormatIncomePl">選択してください</option>
                    @foreach ($categoryProfit as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputIncomePlKubun">
                <label for="inputIncomePlKubun">小科目：</label>
                <select name="kubun_id[]" id="inputIncomePlKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="inputIncomePrice">
            <label for="inputIncomePrice" class="">金額：</label>
            <div class="inputIncomeinputPrice">
                <input type="text" name="price" id="inputIncomePrice" class="form-control" value="" required>
            </div>
        </div>

        <div class="inputIncomeLast">
            <div class="inputIncomeCommentSubmit">
                <label for="inputIncomeComment" class="inputIncomeCommentLabel">コメント：</label>
                <div class="inputIncomeinputComment">
                    <textarea name="comment" id="inputIncomeComment" class="form-control" cols="36"
                        rows="5"></textarea>
                </div>
                <div class="inputIncomeSubmit">
                    <input type="submit" name="inputIncome" id="inputIncomeNew" value="new" class="btn btn-info">
                </div>
            </div>
        </div>

    </form>
</div>
