<div id="inputAccount" class="ui-widget-content">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="inputAccountDate">
            <label for="inputAccountDate" class="">日付：</label>
            <div class="inputAccountinputDate">
                <input type="date" name="date" id="inputAccountDate" class="form-control" value="{{ $today }}" required>
            </div>
            <div class="addBtn">
                <div class="addDebit btn">借方＋</div>
                <div class="delDebit btn">借方－</div>
                <div class="addCredit btn">貸方＋</div>
                <div class="delCredit btn">貸方－</div>
            </div>
        </div>

        <table id="inputAccountTabale">
            <thead>
                <tr class="accountTitle">
                    <th>借方</th>
                    <th>貸方</th>
                </tr>
            </thead>

            <tbody>
                <tr class="totalPrice">
                    <td class="inputDebitTotalPrice" id="">
                        <span>借方合計：</span>
                        <span id="inputDebitTotalPrice"></span>
                    </td>
                    <td class="inputCreditTotalPrice" id="">
                        <span>借方合計：</span>
                        <span id="inputCreditTotalPrice"></span>
                    </td>
                </tr>

                <tr class="accounTop">
                    {{-- 借方 --}}
                    <td class="inputAccountDebit" id="inputAccountDebit0">
                        <input type="hidden" name="debit_credit[]" id="" value="1">
                        <div class="inputAccountDebitCategory">
                            <label for="inputAccountDebitCategory0">科目：</label>
                            <select name="category_id[]" id="inputAccountDebitCategory0" class="form-control" required>
                                <option value="" class="selectFormatDebit" id="selectFormatDebit0">選択してください</option>
                                @foreach ($categoryAll as $k)
                                <option value="{{$k->id}}">{{$k->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="inputAccountDebitKubun">
                            <label for="inputAccountDebitKubun0">小科目：</label>
                            <select name="kubun_id[]" id="inputAccountDebitKubun0" class="form-control" required>
                            </select>
                        </div>

                        <div class="inputAccountDebitPrice">
                            <label for="inputAccountDebitPrice0">金額：</label>
                            <div class="inputAccountDebitPriceInput">
                                <input type="text" name="price[]" id="inputAccountDebitPrice0" class="form-control"
                                    value="" required>
                            </div>
                        </div>
                        </div>
                    </td>

                    {{-- 貸方 --}}
                    <td class="inputAccountCredit">
                        <input type="hidden" name="debit_credit[]" id="" value="2">
                        <div class="inputAccountCreditCategory">
                            <label for="inputAccountCreditCategory0">科目：</label>
                            <select name="category_id[]" id="inputAccountCreditCategory0" class="form-control" required>
                                <option value="" class="selectFormatCredit" id="selectFormatCredit0">選択してください</option>
                                @foreach ($categoryAll as $k)
                                <option value="{{$k->id}}">{{$k->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="inputAccountCreditKubun">
                            <label for="inputAccountCreditKubun0">小科目：</label>
                            <select name="kubun_id[]" id="inputAccountCreditKubun0" class="form-control" required>
                            </select>
                        </div>

                        <div class="inputAccountCreditPrice">
                            <label for="inputAccountCreditPrice0">金額：</label>
                            <div class="inputAccountCreditPriceinput" id="inputAccountCreditPriceinput0">
                                <input type="text" name="price[]" id="inputAccountCreditPrice0" class="form-control"
                                    value="{{ old('price[]') }}" required>
                            </div>
                        </div>
                    </td>
                </tr>
        </table>

        <table class="table" id="inputAccountCommentTabale">
            <thead></thead>
            <tr class="detailEnd">
                <td colspan="2">
                    <div class="inputAccountComment">
                        <div class="inputAccountCommentSubmit">
                            <label for="inputAccountComment" class="inputAccountCommentLabel">コメント：</label>
                            <div class="inputAccountComment">
                                <textarea name="comment" id="inputAccountComment" class="form-control" cols="36"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>

        </table>
        <div class="inputAccountSubmit mb-3" id="">
            <input type="hidden" name="submit" value="inputAccount">
            <input type="submit" name="inputAccount" id="inputAccountNew" value="new" class="btn btn-info">
        </div>
    </form>
</div>
