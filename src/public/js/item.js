let ajaxDetailDebit = [];
let ajaxDetailCredit = [];
let ajaxDetail = [];
let ajaxNomal = [];

// モーダル背景
$(function () {
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#detailAccount").fadeOut();
        $("#detailNomal").fadeOut();
        $('.detailAccountDebitTr').fadeOut();
        $('.detailAccountCreditTr').fadeOut();
        $('.detailAccountBtn').fadeOut();
    })

    // ------------------------
    // detail account
    // ------------------------
    $(".itemDetailaccount").click(function () {
        console.log('--- detail show : account ---');
        // 変数
        countDebitTr = $('.detailAccountDebitTr').length;
        countCreditTr = $('.detailAccountCreditTr').length;

        // disableを設定
        $("#detailAccountDate").prop('disabled', true);
        $(".detailAccountDebitPrice input").prop('disabled', true);
        $(".detailAccountCreditPrice input").prop('disabled', true);

        $(`#detailAccountDebitCategory0`).prop('disabled', true);
        $(`#detailAccountDebitKubun0`).prop('disabled', true);

        $(`#detailAccountCreditCategory0`).prop('disabled', true);
        $(`#detailAccountCreditKubun0`).prop('disabled', true);

        // 元の値を削除
        $(`#detailAccountDebitCategory0`).children().remove();
        $(`#detailAccountDebitKubun0`).children().remove();
        $(`#detailAccountCreditCategory0`).children().remove();
        $(`#detailAccountCreditKubun0`).children().remove();

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
        $('.btnEdit').prop('disabled', false);
        $('.btnUpdate').prop('disabled', true);

        $.ajax({
            type: "get",
            url: "/items/show/a",
            data: {
                book_no: $(this).val(),
            }
        }).done(function (ret) {
            console.log(ret);

            ajaxDetailDebit = [];
            ajaxDetailCredit = [];
            let d = 0, c = 0;
            var html = '';
            var countDebit = 1, countCredit = 1;

            $('.detailAccountBookNo').text(ret[0].book_no);
            $('#detailAccountDate').val(ret[0].date);
            $('#detailAccountComment').text(ret[0].comment);

            $.each(ret, function (k, v) {
                if (v.debit_credit == 1) {
                    ajaxDetailDebit[d] = v;
                    d++;
                } else if (v.debit_credit == 2) {
                    ajaxDetailCredit[c] = v;
                    c++;
                }
                // 貸借が1つずつの場合：valueに値を入れる
                if (k < 2) {
                    // 借方
                    if (v.debit_credit == 1) {
                        console.log('--- detail show : account debit_0 ---');
                        element = 'Debit';
                        detailHtml(element,v);
                        // 貸方
                    } else if (v.debit_credit == 2) {
                        console.log('--- detail show : account credit_0 ---');
                        element = 'Credit';
                        detailHtml(element,v);
                    }
                    // 貸借のどちらかが複数ある場合：thmlごと追記
                } else if (k > 1) {
                    // 借方
                    if (v.debit_credit == 1) {
                        console.log(`--- detail show : account debit_${countDebit} ---`);
                        html = debitHtml(countDebit, v);
                        countDebit++;
                        // 貸方
                    } else if (v.debit_credit == 2) {
                        console.log(`--- detail show : account credit_${countCredit} ---`);
                        html = creditHtml(countCredit, v);
                        countCredit++;
                    }
                    $('.detailAccount').append(html);
                }
            })
        }).fail(function () {
            alert('error...');
        });
    });

    // ------------------------
    // edit detail account
    // ------------------------
    $(".btnEdit").click(function () {
        // 変数の宣言
        var countDebit = $('.detailAccountDebit').length;
        console.log(countDebit);
        var countCredit = $('.detailAccountCredit').length;
        console.log(countCredit);
        var element = '';

        // ボタンの変更
        $('.btnEdit').prop('disabled', true);
        $('.btnUpdate').prop('disabled', false)

        // disableを解除
        $("#detailAccountDate").prop('disabled', false)
        $(".detailAccountDebitPrice input").prop('disabled', false)
        $(".detailAccountCreditPrice input").prop('disabled', false)
        $(".detailAccountComment textarea").prop('disabled', false)

        console.log('--- detail account edit ---');
        // debit
        $.each(ajaxDetailDebit, function (i, val) {
            console.log('debit :: ' + i);
            // category
            element = `#detailAccountDebitCategory${i}`;
            // 元の値を削除
            $(element).children().remove();
            // 値を取得
            getCategoryByEdit(element, ajaxDetailDebit[i], 1);

            // kubun
            element = `#detailAccountDebitKubun${i}`;
            // 元の値を削除
            $(element).children().remove();
            // 値を取得
            getKubunByEdit(element, ajaxDetailDebit[i], 1);

            // change
            $(document).on("change", `#detailAccountDebitCategory${i}`, function () {
                var data = $(this).val();
                element = `#detailAccountDebitKubun${i}`;
                $(element).children().remove();
                getKubunListByChange(element, data);
            });
        })

        // credit
        $.each(ajaxDetailCredit, function (i, val) {
            console.log('credit :: ' + i);
            // category
            element = `#detailAccountCreditCategory${i}`;
            // 元の値を削除
            $(element).children().remove();
            // 値を取得
            getCategoryByEdit(element, ajaxDetailCredit[i], 2);

            // kubun
            element = `#detailAccountCreditKubun${i}`;
            // 元の値を削除
            $(element).children().remove();
            // 値を取得
            getKubunByEdit(element, ajaxDetailCredit[i], 2);

            // change
            $(document).on("change", `#detailAccountCreditCategory${i}`, function () {
                var element = `#detailAccountCreditKubun${i}`;
                var data = $(this).val();
                $(element).children().remove();
                getKubunListByChange(element, data);
            });
        })
    });

    // ------------------------
    // detail nomal
    // ------------------------
    $(".itemDetailnomal").click(function () {
        console.log('--- detail show : nomal ---');
        $(".glayLayer").fadeIn();
        $("#detailNomal").fadeIn();

        $.get("/ajax/category").done(function (data) {
            $.each(data, function (k, v) {
                $(`#detailNomalDiv1Category`).append($('<option>').text(v.category_name).attr('value', v.id));
            })
        }).fail(function () {
            console.log('error get detail nomal');
        });

        $('#detailNomalCategory0').children().remove();
        $('#detailNomalKubun0').children().remove();
        $('#detailNomalCategory1').children().remove();
        $('#detailNomalKubun1').children().remove();

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
            $('#detailNomalBookNo').text(data[0].book_no);
            $('#detailNomalDate').val(data[0].date);
            $('#detailNomalPrice').val(data[0].price);
            $('#detailNomalComment').val(data[0].comment);

            $.each(data, function (k, v) {
                ajaxNomal = data;
                // categoryy
                $(`#detailNomalCategory${k}`).append($('<option>').text(v.category_name).attr('value', v.category_id));
                // kubun
                if (!v.kubun_id) {
                    $(`#detailNomalKubun${k}`).append($('<option>').text("小区分なし").attr('value', 0));
                } else {
                    $(`#detailNomalKubun${k}`).append($('<option>').text(v.kubun_name).attr('value', v.kubun_id))
                }
            })

        }).fail(function () {
            alert('error ajax detail nomal');
        });
    });


    /**
     * categoryの取得（edit用）
     * @param {string} element
     * @param {array} global_var
     * @param {number} debit_credit
     */
    function getCategoryByEdit(element, global_var, debit_credit, error = null) {
        // --- category ---
        $.get("/ajax/category").done(function (ret) {
            // debit
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
     * category_idに属するkubunの取得（edit用）
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
            $(element).prop('disabled', false);
            if (global_var.debit_credit == debit_credit) {

                if (global_var.category_id == 1) {
                    $(element).append($('<option>').text("小区分なし").attr('value', 0));
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
     * category_idに属するkubunの取得（change用）
     * @param {string} element
     * @param {number} data
     */
    function getKubunListByChange(element, data, error = null) {
        $.ajax({
            type: "get",
            url: "/ajax/kubun_by_category",
            data: { category_id: data }
        }).done(function (ret) {
            if (ret.length == 0) {
                $(element).append($('<option>').text("小区分なし").attr('value', 0));
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
     *
     * @param {*} v
     */
    function detailHtml(element, v) {
        detailId(element, v);
        detailCategory(element, v);
        detailKubun(element, v);
        detailPrice(element, v);
    }

    function detailId(element, v) {
       return $(`#detailAccount${element}Id0`).val(v.id);
    }

    function detailCategory(element, v){
        return $(`#detailAccount${element}Category0`).append($('<option>').text(v.category_name).attr('value', v.category_id));
    }

    function detailKubun(element, v){
        var ret = '';
        if (!v.kubun_id) {
           ret = $(`#detailAccount${element}Kubun0`).append($('<option>').text("小区分なし").attr('value', 0));
        } else {
           ret = $(`#detailAccount${element}Kubun0`).append($('<option>').text(v.kubun_name).attr('value', v.kubun_id))
        }
        return ret;
    }

    function detailPrice(element, v){
       return $(`#detailAccount${element}Price0`).text(v.category_name).attr('value', v.price);
    }

    /**
     * HTMLの生成
     * @param {Number} countDebit
     * @param {any} v
     */
    function debitHtml(countDebit, v) {

        var ret = `
        <tr class="detailAccountDebitTr">

        <td class="detailAccountDebit" id="detailAccountDebit${countDebit}">

        <input type="hidden" name="id[]" value="${v.id}" id="detailAccountDebitId${countDebit}">

        <div class="detailAccountDebitCategory">
            <label for="detailAccountDebitCategory${countDebit}">大区分：</label>

            <select name="category_id[]" id="detailAccountDebitCategory${countDebit}" class="form-control" disabled>

            <option value="${v.category_id}">${v.category_name}</optiuon>
            </select>
        </div>

        <div class="detailAccountDebitKubun">
            <label for="detailAccountDebitKubun${countDebit}">小区分：</label>

            <select name="kubun_id[]" id="detailAccountDebitKubun${countDebit}" class="form-control" disabled>

            <option value="${v.kubun_id}">${v.kubun_name}</optiuon>
            </select>
        </div>

        <div class="detailAccountDebitPrice">
            <label for="detailAccountDebitPrice${countDebit}">金額：</label>

            <div class="detailAccountDebitPriceInput">
                <input type="text" name="price[]" id="detailAccountDebitPrice${countDebit}" class="form-control" value="${v.price}" required disabled>
            </div>
        </div>
        <td></td>
        </tr>
        `;
        return ret;
    }

    /**
     * HTMLの生成
     * @param {Number} countCredit
     * @param {any} v
     */
    function creditHtml(countCredit, v) {
        var ret = `
        <tr class="detailAccountCreditTr">
            <td></td>
            <td class="detailAccountCredit" id="detailAccountCredit${countCredit}">

            <input type="hidden" name="id[]" value="${v.id}" id="detailAccountCreditId${countCredit}">

            <div class="detailAccountCreditCategory">
                <label for="detailAccountCreditCategory${countCredit}">大区分：</label>

                <select name="category_id[]" id="detailAccountCreditCategory${countCredit}" class="form-control" disabled>

                <option value="${v.category_id}">${v.category_name}</optiuon>
                </select>
            </div>

            <div class="detailAccountCreditKubun">
                <label for="detailAccountCreditKubun${countCredit}">小区分：</label>

                <select name="kubun_id[]" id="detailAccountCreditKubun${countCredit}" class="form-control" disabled>

                <option value="${v.kubun_id}">${v.kubun_name}</optiuon>
                </select>
            </div>

            <div class="detailAccountCreditPrice">
                <label for="detailAccountCreditPrice${countCredit}">金額：</label>

                <div class="detailAccountCreditPriceinput">
                    <input type="text" name="price[]" id="detailAccountCreditPriceinput${countCredit}" class="form-control" value="${v.price}" required disabled>
                </div>
            </div>
        </tr>
        `;
        return ret;
    }

});

