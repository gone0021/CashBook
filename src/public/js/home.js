let w = $(window).width();
let h = $(window).height();

let countDebitHome;
let countCreditHome;

let debitSumHome;
let creditSumHome;

let validateFlgDebit;
let validateFlgCredit;

$(function () {
    // ------------------------
    // 簿記風の家計簿
    // ------------------------
    // --- 見た目 ---
    $("#newAccount").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputAccount").fadeIn();
    });

    // --- 日付入力時のバリデーション ---
    $('#inputAccountDate, #inputAccountNew').blur(function () {
        var element = $(`#inputAccountDate`);
        validateDate(element)
    })


    // --- Newボタン時のバリデーション ---
    $('#inputAccountNew').click(function () {
        var ret = 1;
        // 日付
        var element = $(`#inputAccountDate`);
        if (validateDate(element) == 0) {
            ret = 0;
        }
        // 貸借金額
        if (debitSumHome != creditSumHome) {
            alert('貸借が一致しません');
            ret = 0;
        }
        if (ret == 0) {
            return false;
        }
    })

    // ------------------------
    // 簿記風の家計簿：借方
    // ------------------------
    $(document).on("change", '#inputAccountDebitCategory0', function () {
        $('#selectFormatDebit0').remove();

        var data = $(this).val();
        var element = `#inputAccountDebitKubun0`;
        $(element).children().remove();
        getKubunList(element, data);
    });

    // カウントの変数
    countDebitHome = 1;

    // 金額の取得
    $(document).on("blur", '.inputAccountDebitPriceInput', function () {
        debitSumHome = 0;
        for (var i = 0; i < countDebitHome; i++) {
            // 金額の計算
            debitSumHome += parseInt($(`#inputAccountDebitPrice${i}`).val());
        }
        console.log(debitSumHome);
        if (debitSumHome > 0) {
            $(`#inputDebitTotalPrice`).text(debitSumHome);
        } else {
            $(`#inputDebitTotalPrice`).text('---');
        }
    })

    // 0番目の金額のバリデーション
    $(document).on("blur", `#inputAccountDebitPrice0`, function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            validateFlgDebit = 1;
            alert('半角数字のみ');
            return false;
        } else {
            validateFlgDebit = 0;
        }
    })

    // 入力の追加・削除
    $(document).on("click", ".addDebit", function () {
        console.log('countDebit:' + countDebitHome);
        let inputAccountDebit = `
            <tr id="addDebitTr${countDebitHome}"> <td class="inputAccountDebit">
            <input type="hidden" name="debit_credit[]" id="" value="1">
            <div class="inputAccountDebitCategory">
                <label for="inputAccountDebitCategory${countDebitHome}">大区分：</label>
                <select name="category_id[]" id="inputAccountDebitCategory${countDebitHome}" class="form-control">
                    <option value="" class="selectFormatDebit" id="selectFormatDebit${countDebitHome}">選択してください</option>
                </select>
            </div>
            <div class="inputAccountDebitKubun">
                <label for="inputAccountDebitKubun${countDebitHome}">小区分：</label>
                <select name="kubun_id[]" id="inputAccountDebitKubun${countDebitHome}" class="form-control"></select>
            </div>
            <div class="inputAccountDebitPrice">
                <label for="inputAccountDebitPrice${countDebitHome}">金額：</label>
                <div class="inputAccountDebitPriceInput" id="inputAccountDebitPriceInput${countDebitHome}">
                    <input type="text" name="price[]" id="inputAccountDebitPrice${countDebitHome}" class="form-control" value=""
                        required>
                </div>
            </div>
            </td> <td></td></tr>
        `;
        $('#inputAccountTabale').append(inputAccountDebit);
        countDebitHome++;

        for (var i = 1; i < countDebitHome; i++) {
            // category
            if (countDebitHome > 1) {
                var element = `#inputAccountDebitCategory${i}`;
                getCategoryAll(element);
            }

            (function (i) {
                // kubun
                $(document).on("change", `#inputAccountDebitCategory${i}`, function () {
                    console.log('--- countDebit:' + countDebitHome + ' ---');

                    $(`#selectFormatDebit${i}`).remove();

                    var data = $(this).val();
                    var element = `#inputAccountDebitKubun${i}`;
                    $(element).children().remove();
                    getKubunList(element, data);
                });

                // 金額のバリデーション
                $(document).on("blur", `#inputAccountDebitPrice${i}`, function () {
                    console.log('i : ' + i);
                    console.log('count : ' + countDebitHome);
                    // バリデーション
                    var element = $(this);
                    if (validatePrice(element) == 0) {
                        console.log('vf : ' + validateFlgDebit);
                        if (validateFlgDebit == 0) {
                            validateFlgDebit = 1;
                            alert('半角数字のみ');
                            return false;
                        }
                    } else {
                        validateFlgDebit = 0;
                    }
                })
            })(i);
        }
    });

    // 削除
    $(document).on("click", ".delDebit", function () {
        if (countDebitHome > 1) {
            countDebitHome--;
        }
        console.log('countDebit' + countDebitHome);
        $(`#addDebitTr${countDebitHome}`).remove();
    });

    // ------------------------
    // 簿記風の家計簿：貸方
    // ------------------------
    $(document).on("change", '#inputAccountCreditCategory0', function () {
        $('#selectFormatCredit0').remove();

        var data = $(this).val();
        var element = `#inputAccountCreditKubun0`;
        $(element).children().remove();
        getKubunList(element, data);
    });

    // カウントの変数
    countCreditHome = 1;

    // 金額の取得
    $(document).on("blur", '.inputAccountCreditPriceinput', function () {
        creditSumHome = 0;
        for (var i = 0; i < countCreditHome; i++) {
            // 金額の計算
            creditSumHome += parseInt($(`#inputAccountCreditPrice${i}`).val());
        }
        if (creditSumHome > 0) {
            $(`#inputCreditTotalPrice`).text(creditSumHome);
        } else {
            $(`#inputCreditTotalPrice`).text('---');
        }
    })

    // 0番目の金額のバリデーション
    $(document).on("blur", `#inputAccountCreditPrice0`, function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            validateFlgCredit = 1;
            alert('半角数字のみ');
            return false;
        } else {
            validateFlgCredit = 0;
        }
    })

    // 入力の追加・削除
    $(document).on("click", ".addCredit", function () {
        console.log('countCredit' + countCreditHome);
        let inputAccountCredit = `
            <tr id="addCreditTr${countCreditHome}"><td></td>
            <input type="hidden" name="debit_credit[]" id="" value="2">
            <td class="inputAccountCredit" id="inputAccountCredit${countCreditHome}">
            <div class="inputAccountCreditCategory">
                <label for="inputAccountCreditCategory${countCreditHome}">大区分：</label>
                <select name="category_id[]" id="inputAccountCreditCategory${countCreditHome}" class="form-control">
                    <option value="" class="selectFormatCredit" id="selectFormatCredit${countCreditHome}">選択してください</option>
                </select>
            </div>

            <div class="inputAccountCreditKubun" >
                <label for="inputAccountCreditKubun${countCreditHome}">小区分：</label>
                <select name="kubun_id[]" id="inputAccountCreditKubun${countCreditHome}" class="form-control">
                </select>
            </div>

            <div class="inputAccountCreditPrice" >
                <label for="inputAccountCreditPrice${countCreditHome}">金額：</label>
                <div class="inputAccountCreditPriceinput" id="inputAccountCreditPriceinput${countCreditHome}">
                    <input type="text" name="price[]" id="inputAccountCreditPrice${countCreditHome}" class="form-control" value=""
                        required>
                </div>
            </div>
            </td></tr>
        `;
        $('#inputAccountTabale').append(inputAccountCredit);
        countCreditHome++;

        for (var i = 1; i < countCreditHome; i++) {
            // category
            if (countCreditHome > 1) {
                var element = `#inputAccountCreditCategory${i}`;
                getCategoryAll(element);
            }

            (function (i) {
                // kubun
                $(document).on("change", `#inputAccountCreditCategory${i}`, function () {
                    console.log('--- countCredit:' + countCreditHome + ' ---');

                    $(`#selectFormatCredit${i}`).remove();

                    var data = $(this).val();
                    var element = `#inputAccountCreditKubun${i}`;
                    $(element).children().remove();
                    getKubunList(element, data);
                });

                // 金額のバリデーション
                $(document).on("blur", `#inputAccountCreditPrice${i}`, function () {
                    console.log('i : ' + i);
                    console.log('count : ' + countCreditHome);
                    // バリデーション
                    var element = $(this);
                    if (validatePrice(element) == 0) {
                        console.log('vf : ' + validateFlgCredit);
                        if (validateFlgCredit == 0) {
                            validateFlgCredit = 1;
                            alert('半角数字のみ');
                            return false;
                        }
                    } else {
                        validateFlgCredit = 0;
                    }
                })
            })(i);
        }
    });

    // 削除
    $(document).on("click", ".delCredit", function () {
        if (countCreditHome > 1) {
            countCreditHome--;
        }
        console.log('countCredit' + countCreditHome);
        $(`#addCreditTr${countCreditHome}`).remove();
    });


    // ------------------------
    // 1対1の家計簿
    // ------------------------
    // --- 支出 ---
    $("#newExpense").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputExpense").fadeIn();
    });

    // 日付のバリデーション
    $('#inputExpenseDate').blur(function () {
        var element = $(this);
        if (validateDate(element) == 0) {
            return false;
        }
    })

    // 金額のバリデーション
    $("#inputExpensePrice").blur(function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            alert('半角数字のみ');
            return false;
        }
    });

    // newボタン時のバリデーション
    $('#inputExpenseNew').click(function () {
        var ret = 1;
        var date = $('inputExpenseDate');
        if (validatePrice(date) == 0) {
            ret = 0;
        }
        var price = $('#inputExpensePrice');
        if (validatePrice(price) == 0) {
            ret = 0;
        }
        if (ret == 0) {
            alert('半角数字のみ');
            return false;
        }
    })

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

    // --- 収入 ---
    $("#newIncome").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputIncome").fadeIn();
    });

    // 日付のバリデーション
    $('#inputIncomeDate').blur(function () {
        var element = $(this);
        if (validateDate(element) == 0) {
            return false;
        }
    })

    // 金額のバリデーション
    $("#inputIncomePrice").blur(function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            alert('半角数字のみ');
            return false;
        }
    });

    // newボタン時のバリデーション
    $('#inputIncomeNew').click(function () {
        var ret = 1;
        var date = $('#inputIncomeDate');
        if (validatePrice(date) == 0) {
            ret = 0;
        }
        var price = $('#inputIncomePrice');
        if (validatePrice(price) == 0) {
            ret = 0;
        }
        if (ret == 0) {
            alert('半角数字のみ');
            return false;
        }
    })

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

    // ------------------------
    // 背景
    // ------------------------
    // モーダル背景
    $('#inputAccount').click(function () {
        validateFlgDebit = 0;
        validateFlgCredit = 0;
    })
    // グレー背景
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#inputExpense").fadeOut();
        $("#inputIncome").fadeOut();
        $("#inputAccount").fadeOut();
        validateFlgDebit = 0;
        validateFlgCredit = 0;
    });


    // ------------------------
    // method
    // ------------------------
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

    /**
     * 日付のバリデーション
     * @param {string} element
     * @return {number} 0：否、1：正
     */
    function validateDate(element) {
        var val = element.val();
        console.log(val);
        if (!val.match(/^\d{4}\-\d{2}\-\d{2}$/)) {
            $(element).addClass('is-invalid');
            alert('正しい日付を入力してください');
            return 0;
        } else {
            element.removeClass('is-invalid');
        }

        var y = val.split("-")[0];
        var m = val.split("-")[1] - 1;
        var d = val.split("-")[2];
        if (y < 2010) {
            $(element).addClass('is-invalid');
            alert('2010年以降で入力してください');
            return 0;
        } else {
            element.removeClass('is-invalid');
        }

        return 1;
    }

    /**
     * 日付のバリデーション
     * @param {number} element
     * @return {number} 0：否、1：正
     */
    function validatePrice(element) {
        var val = element.val();
        if (!val) {
            element.addClass('is-invalid');
        } else if (!val.match(/^[0-9]+$/)) {
            element.addClass('is-invalid');
            return 0;
        } else {
            element.removeClass('is-invalid');
        }
        return 1;
    }

});
