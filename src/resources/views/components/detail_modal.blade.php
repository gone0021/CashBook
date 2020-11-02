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
                <th colspan="2" class="text-center">
                    <span class="debit">{{ __('Debit') }}</span>
                </th>

                <th colspan="2" class="text-center">
                    <span class="credit">{{ __('Credit')}}</span>
                </th>
            </tr>
        </thead>

        {{-- 表示内容 --}}
        <tbody class="detailModal">
        </tbody>
    </table>

    <div class="detailModalBtn col-md-10">
        <span class="btEditPrice btn btn-info mr-3">{{ __('EditPrice') }}</span>
        <span class="btn btn-info btEdit mr-3">{{ __('Edit') }}</span>
        <span class="btn btn-info">{{ __('Delete') }}</span>
    </div>
</div>
