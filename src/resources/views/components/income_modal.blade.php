<div id="incomeModal">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="incomeModalDate mr-4">
            <label for="incomeModalDate" class="">日付：</label>
            <div class="incomeModalinputDate">
                <input type="date" name="date" id="incomeModalDate" class="form-control" value="" required>
            </div>
        </div>

        <div class="incomeModalAsset">
            <input type="hidden" name="debit_credit[]" id="" value="1">
            <div class="incomeModalAssetCategory">
                <label for="incomeModalAssetCategory">収入：</label>
                <select name="category_id[]" id="incomeModalAssetCategory" class="form-control" required>
                    <option value="" class="selectFormatIncomeAccet">選択してください</option>
                    @foreach ($categoryAccet as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                    {{-- {{ $categoryAccet }} --}}
                </select>
            </div>

            <div class="incomeModalAssetKubun">
                <label for="incomeModalAssetKubun">小区分：</label>
                <select name="kubun_id[]" id="incomeModalAssetKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="incomeModalCost">
            <input type="hidden" name="debit_credit[]" id="" value="2">
            <div class="incomeModalCostCategory">
                <label for="incomeModalCostCategory">内容：</label>
                <select name="category_id[]" id="incomeModalCostCategory" class="form-control" required>
                    <option value="" class="selectFormatIncomeCost">選択してください</option>
                    @foreach ($categoryprofit as $k)
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="incomeModalCostKubun">
                <label for="incomeModalCostKubun">小区分：</label>
                <select name="kubun_id[]" id="incomeModalCostKubun" class="form-control" required>
                </select>
            </div>
        </div>

        <div class="incomeModalPrice mr-4">
            <label for="incomeModalPrice" class="">金額：</label>
            <div class="incomeModalinputPrice">
                <input type="text" name="price" id="incomeModalPrice" class="form-control" value="" required>
            </div>
        </div>

        <div class="incomeModalLast">
            <div class="incomeModalCommentSubmit">
                <label for="incomeModalComment" class="incomeModalCommentLabel">コメント：</label>
                <div class="incomeModalinputComment">
                    <textarea name="comment" id="incomeModalComment" class="form-control" cols="30"
                        rows="5"> {{ old('comment') }}</textarea>
                </div>
                <input type="submit" name="" id="" value="new" class="btn btn-info">
            </div>
        </div>

    </form>
</div>
