<div id="accountModal">
    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <div class="accountModalDate">
            <label for="accountModalDate" class="">日付：</label>
            <div class="accountModalinputDate">
                <input type="date" name="date" id="accountModalDate" class="form-control" value="{{ $today }}" required>
            </div>
            <div class="addBtn">
                <div class="addDebit btn">借方＋</div>
                <div class="delDebit btn">借方－</div>
                <div class="addCredit btn">貸方＋</div>
                <div class="delCredit btn">貸方－</div>
            </div>
        </div>

        <table class="accountModalTabale">
            <thead>
                <tr class="accountTitle">
                    <th>借方</th>
                    <th>貸方</th>
                </tr>
            </thead>

            <tbody>
                <tr class="totalPrice">
                    <td class="debitTotalPrice" id="">
                        <label for="debitTotalPrice">借方合計：</label>
                        <div class="debitTotalPriceInput" id="">
                            <input type="text" name="" id="debitTotalPrice" class="form-control" value="" disabled>
                        </div>
                    </td>
                    <td class="creditTotalPrice" id="">
                        <label for="creditTotalPrice" class="">貸方合計：</label>
                        <div class="creditTotalPriceInput" id="">
                            <input type="text" name="" id="creditTotalPrice" class="form-control" value="" disabled>
                        </div>
                    </td>
                </tr>

                <tr class="accounTop">
                    {{-- 借方 --}}
                    <td class="accountModalDebit" id="accountModalDebit0">
                        <div class="accountModalDebitCategory">
                            <label for="accountModalDebitCategory0">大区分：</label>
                            <select name="category[]" id="accountModalDebitCategory0" class="form-control">
                                <option value="" class="selectFormatDebit" id="selectFormatDebit0">選択してください</option>
                                @foreach ($categoryAll as $k)
                                <option value="{{$k->id}}">{{$k->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="accountModalDebitKubun">
                            <label for="accountModalDebitKubun0">小区分：</label>
                            <select name="kubun[]" id="accountModalDebitKubun0" class="form-control">
                            </select>
                        </div>

                        <div class="accountModalDebitPrice">
                            <label for="accountModalDebitPrice0">金額：</label>
                            <div class="accountModalDebitPriceInput">
                                <input type="text" name="price[]" id="accountModalDebitPrice0" class="form-control"
                                    value="" required>
                            </div>
                        </div>
                    </td>

                    {{-- 貸方 --}}
                    <td class="accountModalCredit">
                        <div class="accountModalCreditCategory" id="accountModalCreditCategory0">
                            <label for="accountModalCreditCategory0">大区分：</label>
                            <select name="category[]" id="accountModalCreditCategory0" class="form-control">
                                <option value="" class="selectFormatCredit" id="selectFormatCredit0">選択してください</option>
                                @foreach ($categoryAll as $k)
                                <option value="{{$k->id}}">{{$k->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="accountModalCreditKubun">
                            <label for="accountModalCreditKubun0">小区分：</label>
                            <select name="kubun[]" id="accountModalCreditKubun0" class="form-control">
                            </select>
                        </div>

                        <div class="accountModalCreditPrice">
                            <label for="accountModalCreditPrice0">金額：</label>
                            <div class="accountModalCreditPriceinput" id="accountModalCreditPriceinput0">
                                <input type="text" name="price[]" id="accountModalCreditPrice0" class="form-control"
                                    value="" required>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
        <div class="accountModalSubmit" id="">
            <input type="submit" name="" id="" value="new" class="btn btn-info">
        </div>
    </form>
</div>
