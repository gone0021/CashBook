// accountModalの貸借の追加テーブル
// let accountMdal debit items
// category
let debitCategoryLabel = '<div class="accountModalDebitCategory"> <label for="accountModalDebitCategory">大区分：</label>';
let debitCategorySelect = '<select name="category[]" id="accountModalDebitCategory" class="form-control">';
let debitCategoryOpsion = '<option value="" class="selectFormatDebit">選択してください</option>';
let debitCategoryFin = '</select></div>'
// kubun
let debitKubunLabel = '<div class="accountModalDebitKubun"> <label for="accountModalDebitKubun">小区分：</label>';
let debitKubunSelect = '<select name="kubun[]" id="accountModalDebitKubun" class="form-control">';
let debitKubunFin = '</select></div>'
// price
let debitPriceLabel = '<div class="accountModalDebitPrice"> <label for="accountModalDebitPrice">金額：</label>';
let debitPriceInput = '<div class="accountModalDebitPriceInput"> <input type="text" name="price[]" id="accountModalDebitPrice" class="form-control" value="" required> </div>';
// 変数のセット
let debitStart = '<tr class=""> <td class="accountModalDebit">';
let debitCategory = debitCategoryLabel + debitCategorySelect + debitCategoryOpsion + debitCategoryFin;
let debitKubun = debitKubunLabel + debitKubunSelect + debitKubunFin;
let debitPrice = debitPriceLabel + debitPriceInput + '</div>';
let debitEnd = '</td> <td></td></tr>';
let addDebit = debitStart + debitCategory + debitKubun + debitPrice + debitEnd;

// let accountMdal credit items
// category
let CreditCategoryLabel = '<div class="accountModalCreditCategory"> <label for="accountModalCreditCategory">大区分：</label>';
let CreditCategorySelect = '<select name="category[]" id="accountModalCreditCategory" class="form-control">';
let CreditCategoryOpsion = '<option value="" class="selectFormatCredit">選択してください</option>';
let creditCategoryFin = '</select></div>'
// kubun
let creditKubunLabel = '<div class="accountModalCreditKubun"> <label for="accountModalCreditKubun">小区分：</label>';
let creditKubunSelect = '<select name="kubun[]" id="accountModalCreditKubun" class="form-control">';
let CreditKubunFin = '</select></div>'
// price
let creditPriceLabel = '<div class="accountModalCreditPrice"> <label for="accountModalCreditPrice">金額：</label>';
let creditPriceInput = '<div class="accountModalCreditPriceinput"> <input type="text" name="price[]" id="accountModalCreditPrice" class="form-control" value="" required> </div>';
// 変数のセット
let CreditStart = '<tr class=""> <td></td> <td class="accountModalCredit">';
let CreditCategory = CreditCategoryLabel + CreditCategorySelect + CreditCategoryOpsion + creditCategoryFin;
let CreditKubun = creditKubunLabel + creditKubunSelect + CreditKubunFin;
let CreditPrice = creditPriceLabel + creditPriceInput + '</div>';
let CreditEnd = '</td></tr>';
let addCredit = CreditStart + CreditCategory + CreditKubun + CreditPrice + CreditEnd;

let new_flag = false;
let modal_flag = false;

let w = $(window).width();
let h = $(window).height();

// 簿記風modal
$(function () {
    $("#newAccount").click(function () {
        $(".glayLayer").fadeIn();
        $("#accountModal").fadeIn();
    });
    // 借方追加ボタン
    $(".addDebit").click(function () {
        $('.accountModalTabale').append(addDebit);
    });

    // 借方追加ボタン
    $(".addCredit").click(function () {
        $('.accountModalTabale').append(addCredit);
        let nowHeight = $('#accountModal').height();
        let newHeight = nowHeight + 170 + 10 + 'px';

        let hSpase = (h-nowHeight)/3;

        if (h/6 < hSpase) {
            $('#accountModal').css('height', newHeight);
        }
        // alert(h/10);
        // alert(hSpase);
    });

    // 追加の削除
    $(document).on("click", ".btCancel", function () {
        $(this).parent().remove();
    });

    // キャンセル
    $("#btCancelAll").click(function () {
        new_flag = false;
        $(".add").remove();
        // $('#new').detach();
    });

});

// 支出modal
$(function () {
    $("#newExpense").click(function () {
        $(".glayLayer").fadeIn();
        $("#expenseModal").fadeIn();
    });
});

// 収入modal
$(function () {
    $("#newIncome").click(function () {
        $(".glayLayer").fadeIn();
        $("#incomeModal").fadeIn();
    });
});

// 詳細modal
$(function () {
    $(".itemDetail").click(function () {
        $(".glayLayer").fadeIn();
        $("#detailModal").fadeIn();
        $(".detailModalBtn").fadeIn();
    });

    $(".btEditPrice").click(function () {
        $(".detailModalDebitPrice input").prop('disabled', false)
        $(".detailModalCreditPrice input").prop('disabled', false)
    });
});

// モーダル背景
$(function () {
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#expenseModal").fadeOut();
        $("#incomeModal").fadeOut();
        $("#accountModal").fadeOut();

        $("#detailModal").fadeOut();
        $('.detailModalDebitTr').fadeOut();
        $('.detailModalCreditTr').fadeOut();
        $('.detailModalBtn').fadeOut();
    });
});


$(function () {
    // 削除アラート
    $('.btDel').click(function (e) {
        var message = [
            '削除します'
        ].join('\n')
        if (!window.confirm(message)) {
            e.preventDefault()
        }
    });

});
