// 詳細modal
$(function () {
    $(".btEditPrice").click(function () {
        $(".detailModalDebitPrice input").prop('disabled', false)
        $(".detailModalCreditPrice input").prop('disabled', false)
    });
});

// モーダル背景
$(function () {
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#detailModal").fadeOut();
        $('.detailModalDebitTr').fadeOut();
        $('.detailModalCreditTr').fadeOut();
        $('.detailModalBtn').fadeOut();

    });
});



// 詳細ボタンのクリック
$(function () {
    $(".itemDetail").click(function () {
        $("#detailModal").fadeIn();
        $(".glayLayer").fadeIn();
        $(".detailModalBtn").fadeIn();

        // ここから仮：正常に動いてるけどfalse宣言に違和感
        let detailTop = false;
        if (!detailTop) {
            $('.detailTop').remove(); // 値があったらTopを削除して作り直し
            detailTop = `
            <tr class="detailTop">
                {{-- 借方 --}}
                <td class="detailModalDebit" id="detailModalDebit0">
                    <div class="detailModalDebitCategory">
                        <label for="detailModalDebitCategory0">大区分：</label>
                        <select name="category[]" id="detailModalDebitCategory0" class="form-control" disabled>
                        </select>
                    </div>

                    <div class="detailModalDebitKubun">
                        <label for="detailModalDebitKubun0">小区分：</label>
                        <select name="kubun[]" id="detailModalDebitKubun0" class="form-control" disabled>
                        </select>
                    </div>

                    <div class="detailModalDebitPrice">
                        <label for="detailModalDebitPrice0">金額：</label>
                        <div class="detailModalDebitPriceInput">
                            <input type="text" name="price[]" id="detailModalDebitPrice0" class="form-control" required disabled>
                        </div>
                    </div>
                </td>

                // {{-- 貸方 --}}
                <td class="detailModalCredit">
                    <div class="detailModalCreditCategory" id="detailModalCreditCategory">
                        <label for="detailModalCreditCategory0">大区分：</label>
                        <select name="category[]" id="detailModalCreditCategory0" class="form-control" disabled>
                        </select>
                    </div>

                    <div class="detailModalCreditKubun">
                        <label for="detailModalCreditKubun0">小区分：</label>
                        <select name="kubun[]" id="detailModalCreditKubun0" class="form-control" disabled>
                        </select>
                    </div>

                    <div class="detailModalCreditPrice">
                        <label for="detailModalCreditPrice0">金額：</label>
                        <div class="detailModalCreditPriceinput" id="detailModalCreditPriceinput0">
                            <input type="text" name="price[]" id="detailModalCreditPrice0" class="form-control"  required disabled>
                        </div>
                    </div>
                </td>
            </tr>`;

            $('.detailModal').append(detailTop);
        }

        // ここまで仮

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/items/show/a",
            data: {
                book_no: $(this).val()
            }
        }).done(function (data) {
            console.log(data);
            $('.detailModalBookNo').text(data[0].book_no);
            $('.detailModalDate').text(data[0].date);

            for (var i in data) {
                // 貸借が1つずつの場合：valueに値を入れる
                if (i < 2) {
                    if (data[i].debit_credit == 1) {
                        console.log('index:' + i);
                        // debit category
                        $(`#detailModalDebitCategory0`).append($('<option>').text(data[i].category_name).attr('value', data[i].category_id));
                        // debit kubun
                        if (!data[i].kubun_id) {
                            $(`#detailModalDebitKubun0`).append($('<option>').text("小区分なし").attr('value', 'null'));
                        } else {
                            $(`#detailModalDebitKubun0`).append($('<option>').text(data[i].kubun_name).attr('value', data[i].kubun_id))
                        }
                        // debit price
                        $(`#detailModalDebitPrice0`).text(data[i].category_name).attr('value', data[i].price);

                    } else if (data[i].debit_credit == 2) {
                        console.log('index:' + i);
                        // credit category
                        $(`#detailModalCreditCategory0`).append($('<option>').text(data[i].category_name).attr('value', data[i].category_id));
                        // credit kubun
                        if (!data[i].kubun_id) {
                            $(`#detailModalCreditKubun0`).append($('<option>').text("小区分なし").attr('value', 'null'));
                        } else {
                            $(`#detailModalCreditKubun0`).append($('<option>').text(data[i].kubun_name).attr('value', data[i].kubun_id))
                        }
                        // credit price
                        $(`#detailModalCreditPrice0`).text(data[i].category_name).attr('value', data[i].price);
                    }
                    // 貸借のどちらかが複数ある場合：thmlごと追記
                } else if (i > 1) {
                    console.log('--- index:' + i + ' ---');

                    if (data[i].debit_credit == 1) {
                        let debitCount = 1;
                        html = `
                        <tr class="detailModalDebitTr">

                        <td class="detailModalDebit" id="detailModalDebit{debitCount}">
                        <div class="detailModalDebitCategory">
                            <label for="detailModalDebitCategory${debitCount}">大区分：</label>
                            <select name="category[]" id="detailModalDebitCategory${debitCount}" class="form-control" disabled>
                            <option name="category[]" id="detailModalDebitCategory${debitCount}">${data[i].category_name}</optiuon>
                            </select>
                        </div>

                        <div class="detailModalDebitKubun">
                            <label for="detailModalDebitKubun${debitCount}">小区分：</label>
                            <select name="kubun[]" id="detailModalDebitKubun${debitCount}" class="form-control" disabled>
                            <option name="category[]" id="detailModalDebitCategory${debitCount}">${data[i].kubun_name}</optiuon>
                            </select>
                        </div>

                        <div class="detailModalDebitPrice">
                            <label for="detailModalDebitPrice${debitCount}">金額：</label>
                            <div class="detailModalDebitPriceInput">
                                <input type="text" name="price[]" id="detailModalDebitPrice${debitCount}" class="form-control" value="${data[i].price}" required disabled>
                            </div>
                        </div>
                        <td></td>
                        </tr>`
                        debitCount++;
                        ;
                    } else if (data[i].debit_credit == 2) {
                        let creditCount = 1;
                        html = `
                        <tr class="detailModalCreditTr">
                        <td></td>
                        <td class="detailModalCredit" id="detailModalCredit${creditCount}">
                        <div class="detailModalCreditCategory">
                            <label for="detailModalCreditCategory${creditCount}">大区分：</label>
                            <select name="category[]" id="detailModalCreditCategory${creditCount}" class="form-control" disabled>
                            <option name="category[]" id="detailModalCreditCategory${creditCount}">${data[i].category_name}</optiuon>
                            </select>
                        </div>

                        <div class="detailModalCreditKubun">
                            <label for="detailModalCreditKubun${creditCount}">小区分：</label>
                            <select name="kubun[]" id="detailModalCreditKubun${creditCount}" class="form-control" disabled>
                            <option name="category[]" id="detailModalCreditCategory${creditCount}">${data[i].kubun_name}</optiuon>
                            </select>
                        </div>

                        <div class="detailModalCreditPrice">
                            <label for="detailModalCreditPrice${creditCount}">金額：</label>
                            <div class="detailModalCreditPriceinput">
                                <input type="text" name="price[]" id="detailModalCreditPriceinput${creditCount}" class="form-control" value="${data[i].price}" required disabled>
                            </div>
                        </div>
                        </tr>`
                        creditCount++;
                        ;
                    }

                    $('.detailModal').append(html);
                }
            }
        }).fail(function () {
            alert('error...');
        });
    });
});


