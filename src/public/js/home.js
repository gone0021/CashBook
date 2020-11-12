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
});

// 借方
$(function () {
    // 追加
    let debitCount = 1;
    $(document).on("click", ".addDebit", function () {
        console.log('debitCount:' + debitCount);
        let accountModalDebit = `
            <tr id="addDebitTr${debitCount}"> <td class="accountModalDebit">
            <div class="accountModalDebitCategory">
                <label for="accountModalDebitCategory${debitCount}">大区分：</label>
                <select name="category[]" id="accountModalDebitCategory${debitCount}" class="form-control">
                    <option value="" class="selectFormatDebit" id="selectFormatDebit${debitCount}">選択してください</option>
                </select>
            </div>
            <div class="accountModalDebitKubun">
                <label for="accountModalDebitKubun${debitCount}">小区分：</label>
                <select name="kubun[]" id="accountModalDebitKubun${debitCount}" class="form-control"></select>
            </div>
            <div class="accountModalDebitPrice">
                <label for="accountModalDebitPrice${debitCount}">金額：</label>
                <div class="accountModalDebitPriceInput" id="accountModalDebitPriceInput${debitCount}">
                    <input type="text" name="price[]" id="accountModalDebitPrice${debitCount}" class="form-control" value=""
                        required>
                </div>
            </div>
            </td> <td></td></tr>
        `;
        $('.accountModalTabale').append(accountModalDebit);
        debitCount++;

        for (let i = 1; i < debitCount; i++) {
            // category
            if (debitCount > 1) {
                $.get("/ajax/category").done(function (data) {
                    $.each(data, function (k, v) {
                        $(`#accountModalDebitCategory${i}`).append($('<option>').text(v.category_name).attr('value', v.id));
                    })
                }).fail(function () {
                    console.log('error get debit category');
                });
            }

            // kubun
            (function (i) {
                $(document).on("change", `#accountModalDebitCategory${i}`, function () {
                    console.log('--- debitCount:' + debitCount + ' ---');

                    $(`#accountModalDebitKubun${i} option`).remove();
                    $(`#selectFormatDebit${i}`).remove();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "get",
                        url: "/ajax/kubun",
                        async: false,   // 非同期通信のfalse
                        data: {
                            id: $(this).val()
                        }
                    }).done(function (data) {
                        if (data.length == 0) {
                            $(`#accountModalDebitKubun${i}`).append($('<option>').text("小区分なし").attr('value', 'null'));
                        } else {
                            console.log('else');
                            $.each(data, function (k, v) {
                                $(`#accountModalDebitKubun${i}`).append($('<option>').text(v.kubun_name).attr('value', v.id));
                            })
                        }
                    }).fail(function () {
                        console.log('error get debit kubun');
                    });
                });
            })(i);
        }
    });

    // trの削除
    $(document).on("click", ".delDebit", function () {
        if (debitCount > 1) {
            debitCount--;
        }
        console.log('debitCount' + debitCount);
        $(`#addDebitTr${debitCount}`).remove();
    });

    $('.accountTitle').click(function () {
        console.log('--- debitCount:' + debitCount + ' ---');
    });
});

// 0番目（最初からある）debitのtr
$(document).on("change", '#accountModalDebitCategory0', function () {
    $('#accountModalDebitKubun0 option').remove();
    $('#selectFormatDebit0').remove();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "get",
        url: "/ajax/kubun",
        data: {
            id: $(this).val()
        }
    }).done(function (data) {
        if (data.length == 0) {
            $('#accountModalDebitKubun0').append($('<option>').text("小区分なし").attr('value', 'null'));
        } else {
            $.each(data, function (k, v) {
                $('#accountModalDebitKubun0').append($('<option>').text(v.kubun_name).attr('value', v.id));
            })
        }
    }).fail(function () {
        alert('error!!!');
    });
});


// 貸方
$(function () {
    // 追加
    let creditCount = 1;
    $(document).on("click", ".addCredit", function () {
        console.log('creditCount' + creditCount);
        let accountModalCredit = `
            <tr id="addCreditTr${creditCount}"><td></td>
            <td class="accountModalCredit" id="accountModalCredit${creditCount}">
            <div class="accountModalCreditCategory">
                <label for="accountModalCreditCategory${creditCount}">大区分：</label>
                <select name="category[]" id="accountModalCreditCategory${creditCount}" class="form-control">
                    <option value="" class="selectFormatCredit" id="selectFormatCredit${creditCount}">選択してください</option>
                </select>
            </div>

            <div class="accountModalCreditKubun" >
                <label for="accountModalCreditKubun${creditCount}">小区分：</label>
                <select name="kubun[]" id="accountModalCreditKubun${creditCount}" class="form-control">
                </select>
            </div>

            <div class="accountModalCreditPrice" >
                <label for="accountModalCreditPrice${creditCount}">金額：</label>
                <div class="accountModalCreditPriceinput" id="accountModalCreditPriceinput${creditCount}">
                    <input type="text" name="price[]" id="accountModalCreditPrice${creditCount}" class="form-control" value=""
                        required>
                </div>
            </div>
            </td></tr>
        `;
        $('.accountModalTabale').append(accountModalCredit);
        creditCount++;

        for (let i = 1; i < creditCount; i++) {
            // category
            if (creditCount > 1) {
                $.get("/ajax/category").done(function (data) {
                    $.each(data, function (k, v) {
                        $(`#accountModalCreditCategory${i}`).append($('<option>').text(v.category_name).attr('value', v.id));
                    })
                }).fail(function () {
                    console.log('error get credit category');
                });
            }

            // kubun
            (function (i) {
                $(document).on("change", `#accountModalCreditCategory${i}`, function () {
                    console.log('--- creditCount:' + creditCount + ' ---');

                    $(`#accountModalCreditKubun${i} option`).remove();
                    $(`#selectFormatCredit${i}`).remove();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "get",
                        url: "/ajax/kubun",
                        async: false,   // 非同期通信のfalse
                        data: {
                            id: $(this).val()
                        }
                    }).done(function (data) {
                        if (data.length == 0) {
                            console.log('if');
                            $(`#accountModalCreditKubun${i}`).append($('<option>').text("小区分なし").attr('value', 'null'));
                        } else {
                            console.log('else');
                            $.each(data, function (k, v) {
                                $(`#accountModalCreditKubun${i}`).append($('<option>').text(v.kubun_name).attr('value', v.id));
                            })
                        }
                    }).fail(function () {
                        console.log('error get credit kubun');
                    });
                });
            })(i);
        }
    });

    // 削除
    $(document).on("click", ".delCredit", function () {
        if (creditCount > 1) {
            creditCount--;
        }
        console.log('creditCount' + creditCount);
        $(`#addCreditTr${creditCount}`).remove();
    });
});

// 0番目（最初からある）creditのtr
$(function () {
    $(document).on("change", '#accountModalCreditCategory0', function () {
        $('#accountModalCreditKubun0 option').remove();
        $('#selectFormatCredit0').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/ajax/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                console.log('if');
                $('#accountModalCreditKubun0').append($('<option>').text("小区分なし").attr('value', 'null'));
            } else {
                console.log('else');
                $.each(data, function (k, v) {
                    $('#accountModalCreditKubun0').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });
});



// キャンセル
$(function () {
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


// モーダル背景
$(function () {
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#expenseModal").fadeOut();
        $("#incomeModal").fadeOut();
        $("#accountModal").fadeOut();
    });
});
