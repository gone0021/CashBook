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

            <tr class="accountTitle">
                <th>借方</th>
                <th>貸方</th>
            </tr>

            <tr class="totalPrice">
                <td class="debitTotalPrice">
                    <label for="debitTotalPrice">借方合計：</label>
                    <div class="debitTotalPriceInput">
                        <input type="text" name="" id="debitTotalPrice" class="form-control" value="" disabled>
                    </div>
                </td>
                <td class="creditTotalPrice">
                    <label for="creditTotalPrice" class="">貸方合計：</label>
                    <div class="creditTotalPriceInput">
                        <input type="text" name="" id="creditTotalPrice" class="form-control" value="" disabled>
                    </div>
                </td>
            </tr>

            <tr class="accounTop ">
                {{-- 借方 --}}
                <td class="accountModalDebit">
                    <div class="accountModalDebitCategory">
                        <label for="accountModalDebitCategory">大区分：</label>
                        <select name="category[]" id="accountModalDebitCategory" class="form-control">
                            <option value="" class="selectFormatDebit">選択してください</option>
                            @foreach ($categoryAll as $k)
                            <option value="{{$k->id}}">{{$k->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="accountModalDebitKubun">
                        <label for="accountModalDebitKubun">小区分：</label>
                        <select name="kubun[]" id="accountModalDebitKubun" class="form-control">
                        </select>
                    </div>

                    <div class="accountModalDebitPrice">
                        <label for="accountModalDebitPrice" class="">金額：</label>
                        <div class="accountModalDebitPriceInput">
                            <input type="text" name="price[]" id="accountModalDebitPrice" class="form-control" value=""
                                required>
                        </div>
                    </div>
                </td>

                {{-- 貸方 --}}
                <td class="accountModalCredit">
                    <div class="accountModalCreditCategory">
                        <label for="accountModalCreditCategory">大区分：</label>
                        <select name="category[]" id="accountModalCreditCategory" class="form-control">
                            <option value="" class="selectFormatCredit">選択してください</option>
                            @foreach ($categoryAll as $k)
                            <option value="{{$k->id}}">{{$k->category_name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="accountModalCreditKubun">
                        <label for="accountModalCreditKubun">小区分：</label>
                        <select name="kubun[]" id="accountModalCreditKubun" class="form-control">
                        </select>
                    </div>

                    <div class="accountModalCreditPrice">
                        <label for="accountModalCreditPrice" class="">金額：</label>
                        <div class="accountModalCreditPriceinput">
                            <input type="text" name="price[]" id="accountModalCreditPrice" class="form-control" value=""
                                required>
                        </div>
                    </div>
                </td>
            </tr>

        </table>
        <div class="accountModalSubmit">
            <input type="submit" name="" id="" value="new" class="btn btn-info">
        </div>
    </form>
</div>
