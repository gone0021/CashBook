<div id="detailModal">

    <div class="mb-3">
        {{-- <input type="text" name="" id="bookNo" value="" disabled> --}}
        <span>book No.</span>
        <span class="detailModalBookNo mr-3"></span>
        <span>date:</span>
        <span class="detailModalDate"></span>
    </div>

    <table class="table" id="tb-item">
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
        {{-- <tbody class="detailModal">
        </tbody> --}}

        <tbody class="detailModal">
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

            {{-- ここからjquery --}}

        </tbody>
    </table>

    <div class="detailModalBtn col-md-10">
        <span class="btEditPrice btn btn-info mr-3">{{ __('EditPrice') }}</span>
        <span class="btn btn-info btEdit mr-3">{{ __('Edit') }}</span>
        <span class="btn btn-info">{{ __('Delete') }}</span>
    </div>
</div>
