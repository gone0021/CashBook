<div id="inputNomal">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="inputNomalDate">
            <label for="inputNomalDate" class="">日付：</label>
            <div class="inputNomalinputDate">
                <input type="date" name="date" id="inputNomalDate" class="form-control" value="{{ $today }}" required>
            </div>
        </div>

        <div class="inputNomalAsset">
            <input type="hidden" name="submit" value="inputNomal">
            <input type="hidden" name="debit_credit[]" id="inputNomalDc0" value="">
            <div class="inputNomalAssetCategory">
                <label for="inputNomalAssetCategory"></label>
                <select name="category_id[]" id="inputNomalAssetCategory" class="form-control">
                    <option value="" class="selectFormatNomalAccet" required>選択してください</option>
                    @foreach ($categoryAccet as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputNomalAssetKubun">
                <label for="inputNomalAssetKubun">小科目：</label>
                <select name="kubun_id[]" id="inputNomalAssetKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="inputNomalPlCategory">
            <input type="hidden" name="debit_credit[]" id="inputNomalDc" value="">
            <div class="inputNomalExpenseCategory">
                <label for="inputNomalCategoryExpnese">内容：</label>
                <select name="category_id[]" id="inputNomalCategoryExpnese" class="form-control" required>
                    <option value="" class="selectFormatNomalPl">選択してください</option>
                    @foreach ($categoryCost as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputNomalIncomeCategory">
                <label for="inputNomalCategoryIncome">内容：</label>
                <select name="category_id[]" id="inputNomalCategoryIncome" class="form-control" required>
                    <option value="" class="selectFormatIncomePl">選択してください</option>
                    @foreach ($categoryProfit as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputNomalPlKubun">
                <label for="inputNomalPlKubun">小科目：</label>
                <select name="kubun_id[]" id="inputNomalPlKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="inputNomalPrice">
            <label for="inputNomalPrice" class="">金額：</label>
            <div class="inputNomalinputPrice">
                <input type="text" name="price" id="inputNomalPrice" class="form-control" value="" required>
            </div>
        </div>

        <div class="inputNomalLast">
            <div class="inputNomalCommentSubmit">
                <label for="inputNomalComment" class="inputNomalCommentLabel">コメント：</label>
                <div class="inputNomalinputComment">
                    <textarea name="comment" id="inputNomalComment" class="form-control" cols="36"
                        rows="5"></textarea>
                </div>
                <div class="inputNomalSubmit">
                    <input type="submit" name="inputNomal" id="inputNomalNew" value="new" class="btn btn-info">
                </div>
            </div>
        </div>

    </form>
</div>
