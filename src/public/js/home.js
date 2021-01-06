let new_flag = false;
let modal_flag = false;

let w = $(window).width();
let h = $(window).height();

let debitSum;
let creditSum;

// --- 見た目 ---
$(function () {
    $("#newAccount").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputAccount").fadeIn();
    });
});

$(function () {
    /**
     * 簿記風の家計簿
     */
    // --- 貸借の金額チェック ---
    $('#inputAccountNew').click(function(){
        if (debitSum != creditSum) {
            alert('貸借が一致しません');
            return false;
        }
    })

    // --- 借方 ---
    $(document).on("change", '#inputAccountDebitCategory0', function () {
        $('#selectFormatDebit0').remove();

        var data = $(this).val();
        var element = `#inputAccountDebitKubun0`;
        $(element).children().remove();
        getKubunList(element, data);
    });

    // カウントの変数
    let countDebit = 1;

    // 金額の取得
    $(document).on("change", '.inputAccountDebitPriceInput', function () {
        debitSum = 0;
        for(var i=0; i<countDebit; i++){
            debitSum += parseInt($(`#inputAccountDebitPrice${i}`).val());
        }
        console.log(debitSum);
        if (debitSum > 0) {
            $(`#inputDebitTotalPrice`).text(debitSum);
        }
    })

    // 入力の追加・削除
    $(document).on("click", ".addDebit", function () {
        console.log('countDebit:' + countDebit);
        let inputAccountDebit = `
            <tr id="addDebitTr${countDebit}"> <td class="inputAccountDebit">
            <input type="hidden" name="debit_credit[]" id="" value="1">
            <div class="inputAccountDebitCategory">
                <label for="inputAccountDebitCategory${countDebit}">大区分：</label>
                <select name="category_id[]" id="inputAccountDebitCategory${countDebit}" class="form-control">
                    <option value="" class="selectFormatDebit" id="selectFormatDebit${countDebit}">選択してください</option>
                </select>
            </div>
            <div class="inputAccountDebitKubun">
                <label for="inputAccountDebitKubun${countDebit}">小区分：</label>
                <select name="kubun_id[]" id="inputAccountDebitKubun${countDebit}" class="form-control"></select>
            </div>
            <div class="inputAccountDebitPrice">
                <label for="inputAccountDebitPrice${countDebit}">金額：</label>
                <div class="inputAccountDebitPriceInput" id="inputAccountDebitPriceInput${countDebit}">
                    <input type="text" name="price[]" id="inputAccountDebitPrice${countDebit}" class="form-control" value=""
                        required>
                </div>
            </div>
            </td> <td></td></tr>
        `;
        $('#inputAccountTabale').append(inputAccountDebit);
        countDebit++;

        for (var i = 1; i < countDebit; i++) {
            // category
            if (countDebit > 1) {
                var element = `#inputAccountDebitCategory${i}`;
                getCategoryAll(element);
            }
            // kubun
            (function (i) {
                $(document).on("change", `#inputAccountDebitCategory${i}`, function () {
                    console.log('--- countDebit:' + countDebit + ' ---');

                    $(`#selectFormatDebit${i}`).remove();

                    var data = $(this).val();
                    var element = `#inputAccountDebitKubun${i}`;
                    $(element).children().remove();
                    getKubunList(element, data);
                });
            })(i);
        }
    });

    // 削除
    $(document).on("click", ".delDebit", function () {
        if (countDebit > 1) {
            countDebit--;
        }
        console.log('countDebit' + countDebit);
        $(`#addDebitTr${countDebit}`).remove();
    });

    // --- 貸方 ---
    $(document).on("change", '#inputAccountCreditCategory0', function () {
        $('#selectFormatCredit0').remove();

        var data = $(this).val();
        var element = `#inputAccountCreditKubun0`;
        $(element).children().remove();
        getKubunList(element, data);
    });

    // カウントの変数
    let countCredit = 1;

    // 金額の取得
    $(document).on("change", '.inputAccountCreditPriceinput', function () {
        creditSum = 0;
        for(var i=0; i<countCredit; i++){
            creditSum += parseInt($(`#inputAccountCreditPrice${i}`).val());
        }
        console.log(creditSum);
        if (creditSum > 0) {
            $(`#inputCreditTotalPrice`).text(creditSum);
        }

    })

    // 入力の追加・削除
    $(document).on("click", ".addCredit", function () {
        console.log('countCredit' + countCredit);
        let inputAccountCredit = `
            <tr id="addCreditTr${countCredit}"><td></td>
            <input type="hidden" name="debit_credit[]" id="" value="2">
            <td class="inputAccountCredit" id="inputAccountCredit${countCredit}">
            <div class="inputAccountCreditCategory">
                <label for="inputAccountCreditCategory${countCredit}">大区分：</label>
                <select name="category_id[]" id="inputAccountCreditCategory${countCredit}" class="form-control">
                    <option value="" class="selectFormatCredit" id="selectFormatCredit${countCredit}">選択してください</option>
                </select>
            </div>

            <div class="inputAccountCreditKubun" >
                <label for="inputAccountCreditKubun${countCredit}">小区分：</label>
                <select name="kubun_id[]" id="inputAccountCreditKubun${countCredit}" class="form-control">
                </select>
            </div>

            <div class="inputAccountCreditPrice" >
                <label for="inputAccountCreditPrice${countCredit}">金額：</label>
                <div class="inputAccountCreditPriceinput" id="inputAccountCreditPriceinput${countCredit}">
                    <input type="text" name="price[]" id="inputAccountCreditPrice${countCredit}" class="form-control" value=""
                        required>
                </div>
            </div>
            </td></tr>
        `;
        $('#inputAccountTabale').append(inputAccountCredit);
        countCredit++;

        for (var i = 1; i < countCredit; i++) {
            // category
            if (countCredit > 1) {
                var element = `#inputAccountCreditCategory${i}`;
                getCategoryAll(element);
            }

            // kubun
            (function (i) {
                $(document).on("change", `#inputAccountCreditCategory${i}`, function () {
                    console.log('--- countCredit:' + countCredit + ' ---');

                    $(`#selectFormatCredit${i}`).remove();

                    var data = $(this).val();
                    var element = `#inputAccountCreditKubun${i}`;
                    $(element).children().remove();
                    getKubunList(element, data);
                });
            })(i);
        }
    });

    // 削除
    $(document).on("click", ".delCredit", function () {
        if (countCredit > 1) {
            countCredit--;
        }
        console.log('countCredit' + countCredit);
        $(`#addCreditTr${countCredit}`).remove();
    });


    /**
     * 1対1の家計簿
     */
    // --- 支出 ---
    $("#newExpense").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputExpense").fadeIn();
    });

    $(document).on("change", '#inputExpenseAssetCategory', function () {
        $('.selectFormatExpenseAccet').remove();
        $('#inputExpenseAssetKubun').children().remove();

        var data = $(this).val();
        var element = `#inputExpenseAssetKubun`;
        getKubunList(element, data);
    });

    $(document).on("change", '#inputExpenseCostCategory', function () {
        $('.selectFormatExpenseCost').remove();
        $('#inputExpenseCostKubun').children().remove();

        var data = $(this).val();
        var element = `#inputExpenseCostKubun`;
        getKubunList(element, data);
    });

    // --- 収入kubun ---
    $("#newIncome").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputIncome").fadeIn();
    });

    // asset
    $(document).on("change", '#inputIncomeAssetCategory', function () {
        $('.selectFormatIncomeAccet').remove();
        $('#inputIncomeAssetKubun').children().remove();

        var data = $(this).val();
        var element = `#inputIncomeAssetKubun`;
        getKubunList(element, data);
    });

    // cost
    $(document).on("change", '#inputIncomeCostCategory', function () {
        $('.selectFormatIncomeCost').remove();
        $('#inputIncomeCostKubun').children().remove();

        var data = $(this).val();
        var element = `#inputIncomeCostKubun`;
        getKubunList(element, data);
    });


    /**
     * categoryの一覧を取得
     * @param {string} element
     */
    function getCategoryAll(element, error = null) {
        $.get("/ajax/category").done(function (ret) {
            $.each(ret, function (k, v) {
                $(element).append($('<option>').text(v.category_name).attr('value', v.id));
            })
        }).fail(function () {
            alert('error!! get category' + error);
        });
    }

    /**
     * category_idに属するkubunの取得
     * @param {string} element
     * @param {number} data
     */
    function getKubunList(element, data, error = null) {
        $.ajax({
            type: "get",
            url: "/ajax/kubun_by_category",
            data: {
                category_id: data,
            }
        }).done(function (ret) {
            if (ret.length == 0) {
                console.log('if');
                // $(element).append($('<option>').text("小区分なし"));
                $(element).append($('<option>').text("小区分なし").attr('value', 0));
            } else {
                console.log('else');
                $.each(ret, function (k, v) {
                    $(element).append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!! get kubun' + error);
        });
    }
});


// モーダル背景
$(function () {
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#inputExpense").fadeOut();
        $("#inputIncome").fadeOut();
        $("#inputAccount").fadeOut();
    });
});
