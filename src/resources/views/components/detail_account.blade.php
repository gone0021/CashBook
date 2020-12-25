<div id="detailAccount">
    <form action="{{ route('items/update') }}" method="POST">
        @csrf

        <div class="mb-3">
            {{-- <input type="text" name="" id="bookNo" value="" disabled> --}}
            <span>book No.</span>
            <span class="detailAccountBookNo mr-3"></span>

            <label for="detailAccountDate" class="">日付：</label>
            <div class="detailAccountinputDate">
                <input type="date" name="date" id="detailAccountDate" class="form-control" value="" disabled required>
            </div>
        </div>

        <table id="detailAccountTable">
            {{-- 表示タイトル --}}
            <thead>
                <tr>
                    <th class="text-center">
                        <span class="debit">{{ __('Debit') }}</span>
                    </th>

                    <th class="text-center">
                        <span class="credit">{{ __('Credit')}}</span>
                    </th>
                </tr>
            </thead>

            {{-- 表示内容 --}}
            <tbody class="detailAccount">
                <tr class="totalPrice">
                    <td class="debitTotalPrice" id="">
                        <label for="debitTotalPrice">{{ __('Debit Total') }}：</label>
                        <div class="debitTotalPriceInput" id="">
                            <input type="text" name="" id="debitTotalPrice" class="form-control" value="" disabled>
                        </div>
                    </td>
                    <td class="creditTotalPrice" id="">
                        <label for="creditTotalPrice" class="">{{ __('Credit Total') }}：</label>
                        <div class="creditTotalPriceInput" id="">
                            <input type="text" name="" id="creditTotalPrice" class="form-control" value="" disabled>
                        </div>
                    </td>
                </tr>

                <tr class="detailTop">
                    {{-- 借方 --}}
                    <td class="detailAccountDebit" id="detailAccountDebit0">
                        <input type="hidden" name="id[]" value="" id="detailAccountDebitId0">
                        <div class="detailAccountDebitCategory">
                            <label for="detailAccountDebitCategory0">大区分：</label>
                            <select name="category_id[]" id="detailAccountDebitCategory0" class="form-control" disabled>
                            </select>
                        </div>

                        <div class="detailAccountDebitKubun">
                            <label for="detailAccountDebitKubun0">小区分：</label>
                            <select name="kubun_id[]" id="detailAccountDebitKubun0" class="form-control" disabled>
                            </select>
                        </div>

                        <div class="detailAccountDebitPrice">
                            <label for="detailAccountDebitPrice0">金額：</label>
                            <div class="detailAccountDebitPriceInput">
                                <input type="text" name="price[]" id="detailAccountDebitPrice0" class="form-control"
                                    required disabled>
                            </div>
                        </div>
                    </td>

                    {{-- 貸方 --}}
                    <td class="detailAccountCredit" id="detailAccountCredit0">
                        <input type="hidden" name="id[]" value="" id="detailAccountCreditId0">
                        <div class="detailAccountCreditCategory" id="detailAccountCreditCategory">
                            <label for="detailAccountCreditCategory0">大区分：</label>
                            <select name="category_id[]" id="detailAccountCreditCategory0" class="form-control"
                                disabled>
                            </select>
                        </div>

                        <div class="detailAccountCreditKubun">
                            <label for="detailAccountCreditKubun0">小区分：</label>
                            <select name="kubun_id[]" id="detailAccountCreditKubun0" class="form-control" disabled>
                            </select>
                        </div>

                        <div class="detailAccountCreditPrice">
                            <label for="detailAccountCreditPrice0">金額：</label>
                            <div class="detailAccountCreditPriceinput" id="detailAccountCreditPriceinput0">
                                <input type="text" name="price[]" id="detailAccountCreditPrice0" class="form-control"
                                    required disabled>
                            </div>
                        </div>
                    </td>
                </tr>
        </table>

        <table class="table" id="detailAccountCommentTable">
            <thead></thead>
            <tbody class="detailAccountComment">
                <tr class="detailEnd">
                    <td colspan="2">
                        <div class="detailAccountComment">
                            <div class="detailAccountCommentSubmit">
                                <label for="detailAccountComment" class="detailAccountCommentLabel">コメント：</label>
                                <div class="detailNomalinputComment">
                                    <textarea name="comment" id="detailAccountComment" class="form-control" cols="36"
                                        rows="3" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="detailAccountBtn col-md-10">
            <button class="btn btn-info btEdit mr-3">{{ __('Edit') }}</button>
            <input type="submit" name="submit" class="btn btn-info btnUpdate mr-3" value="{{ __('Update') }}" disabled>
            <input type="submit" name="submit" class="btn btn-outline-danger btnDel mr-3" value="{{ __('Delete') }}">
        </div>
    </form>
</div>
