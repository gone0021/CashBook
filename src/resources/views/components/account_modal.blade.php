<div id="accountModal">
    <div class="addBtn">
        <div class="addDebit btn">
            <p>借方追加</p>
        </div>
        <div class="addCredit btn">
            <p>貸方追加</p>
        </div>
    </div>

    <form action="{{ route('items/store') }}" method="post">
        @csrf
        <table class="accountModalTabale">
            <tr>
                <th>借方</th>
                <th>貸方</th>
            </tr>
            <tr>
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
                        <label for="accountModalDebitPrice" class="">金額　：</label>
                        <div>
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
                        <label for="accountModalCreditPrice" class="">金額　：</label>
                        <div>
                            <input type="text" name="price[]" id="accountModalCreditPrice" class="form-control" value=""
                                required>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="accountModalDebitCategory">
                        <label for="accountModalDebitCategory">大区分：</label>
                        <select name="tag" id="accountModalDebitCategory" class="form-control">
                            <option value="1">現金</option>
                            <option value="2">普通預金</option>
                            <option value="3">クレジットカード</option>
                        </select>
                    </div>

                    <div class="accountModalDebitKubun">
                        <label for="accountModalDebitKubun">小区分：</label>
                        <select name="tag" id="accountModalDebitKubun" class="form-control">
                            <option value="">aaa</option>
                            <option value="">bbb</option>
                        </select>
                    </div>

                    <div class="accountModalDebitPrice">
                        <label for="accountModalDebitPrice" class="mr-2">金額：</label>
                        <div>
                            <input type="text" name="price" id="accountModalDebitPrice" class="form-control" value=""
                                required>
                        </div>
                    </div>
                </td>
                <td></td>
            </tr>

        </table>
        <div class="accountModalSubmit">
            <input type="submit" name="" id="" value="new" class="btn btn-info">
        </div>
    </form>
</div>
