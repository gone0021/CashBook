<div id="detailAccount" class="ui-widget-content">
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
                    <td class="detailDebitTotalPrice" id="">
                        <span>借方合計：</span>
                        <span id="detailDebitTotalPrice"></span>
                    </td>
                    <td class="detailCreditTotalPrice" id="">
                        <span>借方合計：</span>
                        <span id="detailCreditTotalPrice"></span>
                    </td>
                </tr>

                <tr class="detailTop">
                    {{-- 借方 --}}
                    <td class="detailAccountDebit" id="detailAccountDebit0">
                        <input type="hidden" name="id[]" value="" id="detailAccountDebitId0">
                        <input type="hidden" name="debit_credit[]" id="detailAccountDebitDc0" value="1">

                        <div class="detailAccountDebitCategory">
                            <label for="detailAccountDebitCategory0">科目：</label>
                            <select name="category_id[]" id="detailAccountDebitCategory0" class="form-control" disabled>
                            </select>
                        </div>

                        <div class="detailAccountDebitKubun">
                            <label for="detailAccountDebitKubun0">小科目：</label>
                            <select name="kubun_id[]" id="detailAccountDebitKubun0" class="form-control" disabled>
                            </select>
                        </div>

                        <div class="detailAccountDebitPrice">
                            <label for="detailAccountDebitPrice0">金額：</label>
                            <div class="detailAccountDebitPriceInput">
                                <input type="text" name="price[]" id="detailAccountDebitPrice0" class="form-control" value=""
                                    required disabled>
                            </div>
                        </div>
                    </td>

                    {{-- 貸方 --}}
                    <td class="detailAccountCredit" id="detailAccountCredit0">
                        <input type="hidden" name="id[]" value="" id="detailAccountCreditId0">
                        <input type="hidden" name="debit_credit[]" id="detailAccountCreditDc0" value="2">

                        <div class="detailAccountCreditCategory" id="detailAccountCreditCategory">
                            <label for="detailAccountCreditCategory0">科目：</label>
                            <select name="category_id[]" id="detailAccountCreditCategory0" class="form-control"
                                disabled>
                            </select>
                        </div>

                        <div class="detailAccountCreditKubun">
                            <label for="detailAccountCreditKubun0">小科目：</label>
                            <select name="kubun_id[]" id="detailAccountCreditKubun0" class="form-control" disabled>
                            </select>
                        </div>

                        <div class="detailAccountCreditPrice">
                            <label for="detailAccountCreditPrice0">金額：</label>
                            <div class="detailAccountCreditPriceinput">
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

        <div class="detailAccountBtn col-md-10 mb-3">
            <button id="detailAccountEdit" class="btn btn-info btnEdit mr-3">{{ __('Edit') }}</button>
            <input type="submit" name="submit" id="detailAccountUpdate" class="btn btn-info btnUpdate mr-3" value="{{ __('Update') }}" disabled>
            <input type="submit" name="submit" id="detailAcountDel" class="btn btn-outline-danger btnDel mr-3" value="{{ __('Delete') }}">
        </div>
    </form>
</div>
