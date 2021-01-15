let ajaxAccountDebit = [];
let ajaxAccountCredit = [];
let ajaxDetail = [];
let ajaxNomal = [];

let countDebitItem;
let countCreditItem;

// let debitSumItem;
// let creditSumItem;

let validateFlgDebitItem;
let validateFlgCreditItem;

$(function () {
    // モーダル背景
    $('#detailAccount').click(function () {
        validateFlgDebitItem = 0;
        validateFlgCreditItem = 0;
    })
    // グレー背景

    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#detailAccount").fadeOut();
        $("#detailNomal").fadeOut();
        $('.detailAccountDebitTr').fadeOut();
        $('.detailAccountCreditTr').fadeOut();
        $('.detailAccountBtn').fadeOut();
        $("#inputMsg").fadeOut();
        validateFlgDebitItem = 0;
        validateFlgCreditItem = 0;
    })

    // ------------------------
    // バリデーションメッセージ
    // ------------------------
    let detailValidate = $('#inputMsg').hasClass('inputValidateMsg');
    if (detailValidate) {
        $(".glayLayer").fadeIn();
        $('#inputMsg').fadeIn();
    }

    // ------------------------
    // detail account ： Detailボタン
    // ------------------------
    // --- 見た目 ---
    $("#newAccount").click(function () {
        $(".glayLayer").fadeIn();
        $("#inputAccount").fadeIn();
    });


    // --- 日付入力時のバリデーション ---
    $('#detailAccountDate').blur(function () {
        var element = $(`#detailAccountDate`);
        validateDate(element)
    })

    // --- Newボタン時のバリデーション ---
    $('#detailAccountUpdate').click(function () {
        var ret = 1;
        // 日付
        var element = $(`#detailAccountDate`);
        if (validateDate(element) == 0) {
            ret = 0;
        }
        // 貸借金額
        if (debitSumItem != creditSumItem) {
            alert('貸借が一致しません');
            ret = 0;
        }
        if (ret == 0) {
            return false;
        }
    })

    $(".itemDetailAccount").click(function () {
        console.log('--- detail show : account ---');
        // 変数
        countDebitTr = $('.detailAccountDebitTr').length;
        countCreditTr = $('.detailAccountCreditTr').length;
        console.log(countDebitTr);
        console.log(countCreditTr);

        // disableを設定
        $("#detailAccountDate").prop('disabled', true);
        $(".detailAccountDebitPrice input").prop('disabled', true);
        $(".detailAccountCreditPrice input").prop('disabled', true);

        $(`#detailAccountDebitCategory0`).prop('disabled', true);
        $(`#detailAccountDebitKubun0`).prop('disabled', true);

        $(`#detailAccountCreditCategory0`).prop('disabled', true);
        $(`#detailAccountCreditKubun0`).prop('disabled', true);

        $(`#detailAccountComment`).prop('disabled', true);

        // 元の値を削除
        $(`#detailDebitTotalPrice`).text("");
        $(`#detailCreditTotalPrice`).text("");
        for (var i = 0; i <= countDebitTr; i++) {
            $(`#detailAccountDebitCategory${i}`).children().remove();
            $(`#detailAccountDebitKubun${i}`).children().remove();
            $(`#detailAccountDebitPrice${i}`).val("");
        }
        for (var i = 0; i <= countCreditTr; i++) {
            $(`#detailAccountCreditCategory${i}`).children().remove();
            $(`#detailAccountCreditKubun${i}`).children().remove();
            $(`#detailAccountCreditPrice${i}`).val("");
        }

        if (countDebitTr > 0) {
            $(`.detailAccountDebitTr`).remove();
        }
        if (countCreditTr > 0) {
            $(`.detailAccountCreditTr`).remove();
        }

        // 見た目
        $("#detailAccount").fadeIn();
        $(".glayLayer").fadeIn();
        $(".detailAccountBtn").fadeIn();

        // ボタンの変更
        $('#detailAccountEdit').prop('disabled', false);
        $('#detailAccountUpdate').prop('disabled', true);

        // 値の取得
        $.ajax({
            type: "get",
            url: "/items/show/a",
            data: {
                book_no: $(this).val(),
            }
        }).done(function (ret) {
            console.log(ret);

            ajaxAccountDebit = [];
            ajaxAccountCredit = [];
            let d = 0, c = 0;
            var html = '';
            var countDebitItem = 1, countCreditItem = 1;

            $('.detailAccountBookNo').text(ret[0].book_no);
            $('#detailAccountDate').val(ret[0].date);
            $('#detailAccountComment').text(ret[0].comment);

            debitSumItem = 0;
            creditSumItem = 0;
            $.each(ret, function (k, v) {
                // 貸借ごとにグローバル変数へ値を保存
                if (v.debit_credit == 1) {
                    ajaxAccountDebit[d] = v;
                    d++;
                } else if (v.debit_credit == 2) {
                    ajaxAccountCredit[c] = v;
                    c++;
                }
                // 貸借が1つずつの場合：valueに値を入れる
                if (k < 2) {
                    // 借方
                    if (v.debit_credit == 1) {
                        // 合計金額の計算：出力はforを抜けてから
                        debitSumItem = parseInt(v.price);
                        // 値の取得
                        element = 'AccountDebit';
                        detailHtmlSet(element, 0, v);
                        // 貸方
                    } else if (v.debit_credit == 2) {
                        // 合計金額の計算：出力はforを抜けてから
                        creditSumItem = parseInt(v.price);
                        // 値の取得
                        element = 'AccountCredit';
                        detailHtmlSet(element, 0, v);

                    }
                    // 貸借のどちらかが複数ある場合：thmlごと追記
                } else if (k > 1) {
                    // 借方
                    if (v.debit_credit == 1) {
                        // 合計金額の計算：出力はforを抜けてから
                        debitSumItem += parseInt(v.price);
                        // 値の取得
                        html = debitHtml(countDebitItem, v);
                        countDebitItem++;
                        // 貸方
                    } else if (v.debit_credit == 2) {
                        // 合計金額の計算：出力はforを抜けてから
                        creditSumItem += parseInt(v.price);
                        // 値の取得
                        html = creditHtml(countCreditItem, v);
                        countCreditItem++;
                    }
                    $('.detailAccount').append(html);
                }
                $('#detailDebitTotalPrice').text(debitSumItem);
                $('#detailCreditTotalPrice').text(creditSumItem);
            })
        }).fail(function () {
            alert('error...');
        });
    });

    // ------------------------
    // detail account ： 編集
    // ------------------------
    $("#detailAccountEdit").click(function () {
        // 変数の宣言
        countDebitItem = $('.detailAccountDebit').length;
        console.log(countDebitItem);
        countCreditItem = $('.detailAccountCredit').length;
        console.log(countCreditItem);
        var element = '';

        // ボタンの変更
        $('#detailAccountEdit').prop('disabled', true);
        $('#detailAccountUpdate').prop('disabled', false)

        // disableを解除
        $("#detailAccountDate").prop('disabled', false)
        $(".detailAccountDebitPrice input").prop('disabled', false)
        $(".detailAccountCreditPrice input").prop('disabled', false)
        $(".detailAccountComment textarea").prop('disabled', false)

        console.log('--- detail account edit ---');
        // debit
        $.each(ajaxAccountDebit, function (i, val) {
            console.log('debit :: ' + i);
            // category
            element = `#detailAccountDebitCategory${i}`;
            // 値を取得
            getCategoryByEdit(element, ajaxAccountDebit[i], 1);

            // kubun
            element = `#detailAccountDebitKubun${i}`;
            // 値を取得
            getKubunByEdit(element, ajaxAccountDebit[i], 1);

            // change
            $(document).on("change", `#detailAccountDebitCategory${i}`, function () {
                var data = $(this).val();
                element = `#detailAccountDebitKubun${i}`;
                getKubunListByChange(element, data);
            })

            // 金額のバリデーション
            $(document).on("blur", `#detailAccountDebitPrice${i}`, function () {
                // バリデーション
                console.log('valid credit');
                var element = $(this);
                if (validatePrice(element) == 0) {
                    console.log('vf : ' + validateFlgDebitItem);
                    if (validateFlgDebitItem == 0) {
                        validateFlgDebitItem = 1;
                        alert('半角数字のみ');
                        return false;
                    }
                } else {
                    validateFlgDebitItem = 0;
                }
            })
        });

        // credit
        $.each(ajaxAccountCredit, function (i, val) {
            console.log('credit :: ' + i);
            // category
            element = `#detailAccountCreditCategory${i}`;
            // 値を取得
            getCategoryByEdit(element, ajaxAccountCredit[i], 2);

            // kubun
            element = `#detailAccountCreditKubun${i}`;
            // 値を取得
            getKubunByEdit(element, ajaxAccountCredit[i], 2);

            // change
            $(document).on("change", `#detailAccountCreditCategory${i}`, function () {
                var element = `#detailAccountCreditKubun${i}`;
                var data = $(this).val();
                // $(element).children().remove();
                getKubunListByChange(element, data);
            });

            // 金額のバリデーション
            $(document).on("blur", `#detailAccountCreditPrice${i}`, function () {
                // バリデーション
                console.log('valid credit');
                var element = $(this);
                if (validatePrice(element) == 0) {
                    console.log('vf : ' + validateFlgCreditItem);
                    if (validateFlgCreditItem == 0) {
                        validateFlgCreditItem = 1;
                        alert('半角数字のみ');
                        return false;
                    }
                } else {
                    validateFlgCreditItem = 0;
                }
            })
        })
    });

    // ------------------------
    // edit detail account ： 金額チェック
    // ------------------------
    // 借方金額の取得
    $(document).on("blur", '.detailAccountDebitPrice', function () {
        debitSumItem = 0;
        console.log(countDebitItem);

        for (var i = 0; i < countDebitItem; i++) {
            debitSumItem += parseInt($(`#detailAccountDebitPrice${i}`).val());
        }
        console.log(debitSumItem);
        if (debitSumItem > 0) {
            $(`#detailDebitTotalPrice`).text(debitSumItem);
        } else {
            $(`#detailDebitTotalPrice`).text('---');
        }
    })

    // 貸方金額の取得
    $(document).on("blur", '.detailAccountCreditPrice', function () {
        creditSumItem = 0;
        console.log(countCreditItem);

        for (var i = 0; i < countCreditItem; i++) {
            creditSumItem += parseInt($(`#detailAccountCreditPrice${i}`).val());
        }
        console.log(creditSumItem);
        if (creditSumItem > 0) {
            $(`#detailCreditTotalPrice`).text(creditSumItem);
        } else {
            $(`#detailCreditTotalPrice`).text('---');
        }
    })

    // 0番目の金額のバリデーション：借方
    $(document).on("blur", `#detailAccountDebitPrice0`, function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            validateFlgDebitItem = 1;
            alert('半角数字のみ');
            return false;
        } else {
            validateFlgDebitItem = 0;
        }
    })

    // 0番目の金額のバリデーション：借方
    $(document).on("blur", `#detailAccountCreditPrice0`, function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            validateFlgCreditItem = 1;
            alert('半角数字のみ');
            return false;
        } else {
            validateFlgCreditItem = 0;
        }
    })


    // ------------------------
    // detail nomal ： Detailボタン
    // ------------------------
    $(".itemDetailNomal").click(function () {
        console.log('--- detail show : nomal ---');
        $(".glayLayer").fadeIn();
        $("#detailNomal").fadeIn();

        // ボタンの変更
        $('#detaliNomalEdit').prop('disabled', false);
        $('#detailNomalUpdate').prop('disabled', true)

        // disableを解除
        $("#detailNomalDate").prop('disabled', true)
        $(".detailNomalPrice input").prop('disabled', true)
        $("#detailNomalComment").prop('disabled', true)
        $("#selectNomalDc").prop('disabled', true)

        $('#detailNomalCategory0').prop('disabled', true);
        $('#detailNomalKubun0').prop('disabled', true);
        $('#detailNomalCategory1').prop('disabled', true);
        $('#detailNomalKubun1').prop('disabled', true);

        // 古い値を削除
        $('#detailNomalKubun0').children().remove();
        $('#detailNomalCategory1').children().remove();
        $('#detailNomalKubun1').children().remove();

        // kubunの取得
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/items/show/a",
            data: {
                book_no: $(this).val()
            }
        }).done(function (ret) {
            console.log(ret);
            element = 'Nomal';
            // 値をグローバル編集へ保存
            ajaxNomal = ret;

            // 収支の文字を編集
            if (ret[0].account_type == 1 || ret[1].account_type == 1) {
                $('.detailNomalCategory0 label').text('支出：');
            } else if (ret[0].account_type == 2 || ret[1].account_type == 2) {
                $('.detailNomalCategory0 label').text('収入：');
            }

            // 値を各要素に入れる
            $('#detailNomalBookNo').text(ret[0].book_no);
            $('#detailNomalDate').val(ret[0].date);
            $('#detailNomalComment').val(ret[0].comment);

            $.each(ret, function (k, v) {
                element = 'Nomal';
                detailHtmlSet(element, k, v);
            })

        }).fail(function () {
            alert('error ajax detail nomal');
        });
    });

    // ------------------------
    // detail nomal ： 編集
    // ------------------------
    $("#detaliNomalEdit").click(function () {
        var element = '';

        // ボタンの変更
        $('#detaliNomalEdit').prop('disabled', true);
        $('#detailNomalUpdate').prop('disabled', false)

        // disableを解除
        $("#detailNomalDate").prop('disabled', false)
        $(".detailNomalPrice input").prop('disabled', false)
        $("#detailNomalComment").prop('disabled', false)
        $("#selectNomalDc").prop('disabled', false)

        console.log('--- detail Nomal edit ---');
        // 値の取得
        $.each(ajaxNomal, function (i, val) {
            // category
            var category = `#detailNomalCategory${i}`;
            $.ajax({
                type: "get",
                url: "/ajax/category_by_account",
                data: { account_type: val.account_type }
            }).done(function (ret) {
                console.log(ret);
                $.each(ret, function (k, v) {
                    if (v.id == val.category_id) {
                        $(category).append($('<option>').text(v.category_name).attr({ 'value': v.id, 'selected': true }));
                    } else {
                        $(category).append($('<option>').text(v.category_name).attr('value', v.id));
                    }
                })
                $(category).prop('disabled', false);
            }).fail(function () {
                alert('error!! get category');
            });

            // kubun
            var kubun = `#detailNomalKubun${i}`;
            $.ajax({
                type: "get",
                url: `/ajax/kubun_by_category`,
                data: { category_id: val.category_id }
            }).done(function (ret) {
                // console.log(ret);
                $(kubun).children().remove();
                $(kubun).prop('disabled', false);
                if (!val.kubun_id) {
                    $(kubun).append($('<option>').text("小科目なし").attr('value', 0));
                } else {
                    $.each(ret, function (k, v) {
                        var selected = false;
                        if (v.id == val.kubun_id) {
                            selected = true;
                        }
                        $(kubun).append($(`<option>`).text(v.kubun_name).attr({ 'value': v.id, 'selected': selected }))
                    })
                }
                $(kubun).prop('disabled', false);
            }).fail(function () {
                alert('error!! get kubun');
            });

            // change
            $(document).on("change", `#detailNomalCategory${i}`, function () {
                var data = $(this).val();
                element = `#detailNomalKubun${i}`;
                getKubunListByChange(element, data);
            });
        })
    });

    // debit_creditの編集
    $('#selectNomalDc').change(function () {
        var data = $(this).val();
        if (data == 1) {
            $('#detailNomalDc0').val(1);
            $('#detailNomalDc1').val(2);
        } else {
            $('#detailNomalDc0').val(2);
            $('#detailNomalDc1').val(1);
        }
    });

    // 日付のバリデーション
    $('#detailNomalDate').blur(function () {
        var element = $(this);
        if (validateDate(element) == 0) {
            return false;
        }
    })

    // 金額のバリデーション
    $("#detailNomalPrice0").blur(function () {
        var element = $(this);
        if (validatePrice(element) == 0) {
            alert('半角数字のみ');
            return false;
        }
    });

    // newボタン時のバリデーション
    $('#detailNomalUpdate').click(function () {
        var ret = 1;
        var date = $('#detailNomalDate');
        if (validateDate(date) == 0) {
            ret = 0;
        }
        var price = $('#detailNomalPrice0');
        if (validatePrice(price) == 0) {
            alert('半角数字のみ');
            ret = 0;
        }
        if (ret == 0) {
            return false;
        }
    })

    // detailNomalPrice1の値をdetailNomalPrice0に合わせる
    $('#detailNomalPrice0').change(function () {
        var val = $(this).val();
        $('#detailNomalPrice1').val(val);
    });


    // ------------------------
    // method
    // ------------------------
    /**
     * categoryの取得（edit：account）
     * @param {string} element
     * @param {array} global_var
     * @param {number} debit_credit
     */
    function getCategoryByEdit(element, global_var, debit_credit, error = null) {
        // --- category ---
        $.get("/ajax/category").done(function (ret) {
            // 元の値を削除
            $(element).children().remove();
            // 値の追加
            $.each(ret, function (k, v) {
                if (global_var.debit_credit == debit_credit) {
                    // category
                    if (v.id == global_var.category_id) {
                        $(element).append($('<option>').text(v.category_name).attr({ 'value': v.id, 'selected': true }));
                    } else {
                        $(element).append($('<option>').text(v.category_name).attr('value', v.id));
                    }
                }
                $(element).prop('disabled', false)
            })
        }).fail(function () {
            alert('error!! get category' + error);
        });
    }

    /**
     * category_idに属するkubunの取得（edit：account）
     * @param {string} element
     * @param {array} global_var
     * @param {number} debit_credit
     */
    function getKubunByEdit(element, global_var, debit_credit, error = null) {
        $.ajax({
            type: "get",
            url: `/ajax/kubun_by_category`,
            // async: true,
            data: { category_id: global_var.category_id }
        }).done(function (ret) {
            // 元の値を削除
            $(element).children().remove();
            // disabledの解除
            $(element).prop('disabled', false);
            // 値の追加
            if (global_var.debit_credit == debit_credit) {
                if (!global_var.kubun_id) {
                    $(element).append($('<option>').text("小科目なし").attr('value', 0));
                } else {
                    $.each(ret, function (k, v) {
                        var selected = false;
                        if (v.id == global_var.kubun_id) {
                            selected = true;
                        }
                        $(element).append($(`<option>`).text(v.kubun_name).attr({ 'value': v.id, 'selected': selected }))
                    })
                }
            }
        }).fail(function () {
            alert('error!! get kubun' + error);
        });
    }

    /**
     * category_idに属するkubunの取得（change用：共通）
     * @param {string} element
     * @param {number} data
     */
    function getKubunListByChange(element, data, error = null) {
        $.ajax({
            type: "get",
            url: "/ajax/kubun_by_category",
            data: { category_id: data }
        }).done(function (ret) {
            $(element).children().remove();
            if (ret.length == 0) {
                $(element).append($('<option>').text("小科目なし").attr('value', 0));
            } else {
                $.each(ret, function (k, v) {
                    $(element).append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!! get kubun' + error);
        });
    }

    /**
     * 複数のメソッドを集めて呼び出す
     * @param {String} element
     * @param {any} v
     */
    function detailHtmlSet(element, k, v) {
        detailId(element, k, v);
        detailDebitCredit(element, k, v);
        detailCategory(element, k, v);
        detailKubun(element, k, v);
        detailPrice(element, k, v);
    }

    function detailId(element, k, v) {
        return $(`#detail${element}Id${k}`).val(v.id);
    }

    function detailDebitCredit(element, k, v) {
        return $(`#detail${element}Dc${k}`).val(v.debit_credit);
    }

    function detailCategory(element, k, v) {
        return $(`#detail${element}Category${k}`).append($('<option>').text(v.category_name).attr('value', v.category_id));
    }

    function detailKubun(element, k, v) {
        var ret = '';
        if (!v.kubun_id) {
            ret = $(`#detail${element}Kubun${k}`).append($('<option>').text("小科目なし").attr('value', 0));
        } else {
            ret = $(`#detail${element}Kubun${k}`).append($('<option>').text(v.kubun_name).attr('value', v.kubun_id))
        }
        return ret;
    }

    function detailPrice(element, k, v) {
        return $(`#detail${element}Price${k}`).val(v.price);
    }

    /**
     * HTMLの生成
     * @param {Number} countDebitItem
     * @param {any} v
     */
    function debitHtml(countDebitItem, v) {
        var ret = `
        <tr class="detailAccountDebitTr">

        <td class="detailAccountDebit" id="detailAccountDebit${countDebitItem}">

        <input type="hidden" name="id[]" value="${v.id}" id="detailAccountDebitId${countDebitItem}">
        <input type="hidden" name="debit_credit[]" id="detailAccountDecitDc${countDebitItem}" value="${v.debit_credit}">

        <div class="detailAccountDebitCategory">
            <label for="detailAccountDebitCategory${countDebitItem}">大科目：</label>

            <select name="category_id[]" id="detailAccountDebitCategory${countDebitItem}" class="form-control" disabled>

            <option value="${v.category_id}">${v.category_name}</optiuon>
            </select>
        </div>

        <div class="detailAccountDebitKubun">
            <label for="detailAccountDebitKubun${countDebitItem}">小科目：</label>

            <select name="kubun_id[]" id="detailAccountDebitKubun${countDebitItem}" class="form-control" disabled>

            <option value="${v.kubun_id}">${v.kubun_name}</optiuon>
            </select>
        </div>

        <div class="detailAccountDebitPrice">
            <label for="detailAccountDebitPrice${countDebitItem}">金額：</label>

            <div class="detailAccountDebitPriceInput">
                <input type="text" name="price[]" id="detailAccountDebitPrice${countDebitItem}" class="form-control" value="${v.price}" required disabled>
            </div>
        </div>
        <td></td>
        </tr>
        `;
        return ret;
    }

    /**
     * HTMLの生成
     * @param {Number} countCreditItem
     * @param {any} v
     */
    function creditHtml(countCreditItem, v) {
        var ret = `
        <tr class="detailAccountCreditTr">
            <td></td>
            <td class="detailAccountCredit" id="detailAccountCredit${countCreditItem}">

            <input type="hidden" name="id[]" value="${v.id}" id="detailAccountCreditId${countCreditItem}">
            <input type="hidden" name="debit_credit[]" id="detailAccountCreditDc${countDebitItem}" value="${v.debit_credit}">

            <div class="detailAccountCreditCategory">
                <label for="detailAccountCreditCategory${countCreditItem}">大科目：</label>

                <select name="category_id[]" id="detailAccountCreditCategory${countCreditItem}" class="form-control" disabled>

                <option value="${v.category_id}">${v.category_name}</optiuon>
                </select>
            </div>

            <div class="detailAccountCreditKubun">
                <label for="detailAccountCreditKubun${countCreditItem}">小科目：</label>

                <select name="kubun_id[]" id="detailAccountCreditKubun${countCreditItem}" class="form-control" disabled>

                <option value="${v.kubun_id}">${v.kubun_name}</optiuon>
                </select>
            </div>

            <div class="detailAccountCreditPrice">
                <label for="detailAccountCreditPrice${countCreditItem}">金額：</label>

                <div class="detailAccountCreditPriceinput">
                    <input type="text" name="price[]" id="detailAccountCreditPrice${countCreditItem}" class="form-control" value="${v.price}" required disabled>
                </div>
            </div>
        </tr>
        `;
        return ret;
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
     * 金額のバリデーション
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

