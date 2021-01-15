/**
 * 支出modal
 */
// 資産科目
$(function () {
    $("#expenseModalAssetCategory").change(function () {
        // alert('ajax');
        $('#expenseModalAssetKubun option').remove();
        $('.selectFormatExpenseAccet').remove();

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
                $('#expenseModalAssetKubun').append($('<option>').text("小科目なし").attr('value', 'null'));
            } else {
                $.each(data, function (k, v) {
                    $('#expenseModalAssetKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });

    // 費用科目
    $("#expenseModalCostCategory").change(function () {
        // alert('ajax');
        $('#expenseModalCostKubun option').remove();
        $('.selectFormatExpenseCost').remove();

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
                $('#expenseModalCosttKubun').append($('<option>').text("小科目なし").attr('value', 'null'));
            } else {
                $.each(data, function (k, v) {
                    $('#expenseModalCostKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });

    });
});

/**
 * 収入modal
 */
// 資産科目
$(function () {
    $("#incomeModalAssetCategory").change(function () {
        // alert('ajax');
        $('#incomeModalAssetKubun option').remove();
        $('.selectFormatIncomeAccet').remove();

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
                $('#incomeModalAssetKubun').append($('<option>').text("小科目なし").attr('value', 'null'));
            } else {
                $.each(data, function (k, v) {
                    $('#incomeModalAssetKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });

    // 費用科目
    $("#incomeModalCostCategory").change(function () {
        // alert('ajax');
        $('#incomeModalCostKubun option').remove();
        $('.selectFormatIncomeCost').remove();

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
                $('#incomeModalCosttKubun').append($('<option>').text("小科目なし").attr('value', 'null'));
            } else {
                $.each(data, function (k, v) {
                    $('#incomeModalCostKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });
});

/**
 * 簿記風modal
 */
// 借方
$(function () {
    $("#accountModalDebitCategory").change(function () {
        // alert('ajax');
        $('#accountModalDebitKubun option').remove();
        $('.selectFormatDebit').remove();

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
                $('#accountModalDebitKubun').append($('<option>').text("小科目なし").attr('value', 'null'));
            } else {
                $.each(data, function (k, v) {
                    $('#accountModalDebitKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });

    // 貸方
    $("#accountModalCreditCategory").change(function () {
        // alert('ajax');
        $('#selectFormatCredit option').remove();
        $('.selectFormatIncomeCost').remove();

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
                $('#accountModalCreditKubun').append($('<option>').text("小科目なし").attr('value', 'null'));
            } else {
                $.each(data, function (k, v) {
                    $('#accountModalCreditKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });
});

/**
 * 詳細modal
 */
$(function () {
    $(".itemDetail").click(function () {
        // alert('ajax');
        // https://qiita.com/hot-and-cool/items/c2e9e651f0e53dd14303#step3-%E3%83%95%E3%83%AD%E3%83%B3%E3%83%88%E5%81%B4
        let html = '';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/items/show",
            data: {
                book_no: $(this).val()
            }
        }).done(function (data) {
            console.log(data);

            $('.detailModalBookNo').text(data[0].book_no);
            $('.detailModalDate').text(data[0].date);

            let kubun_name = '';
            $.each(data, function (k, v) {
                if (v.kubun_name) {
                    kubun_name = '<p>' + v.kubun_name + '</p>';
                } else {
                    kubun_name = '<p>' + '小科目なし' + '</p>';
                }

                if (v.debit_credit == 1) {
                    html = `
                    <tr class="detailModalDebitTr">
                    <td class="detailModalDebitName align-middle" width="25%">
                    <p class="ml-2">${v.category_name}</p>
                    <p>${kubun_name}</p>
                    </td>

                    <td class="detailModalDebitPrice align-middle" width="25%">
                        <input name="price[] id="" value="${v.price}" disabled>円

                        <br><p class="ml-2">${v.price}円</p>
                    </td>
                    <td></td>
                    <td></td>
                    </tr>`;
                }
                else if (v.debit_credit == 2) {
                    html = `
                    <tr class="detailModalCreditTr">
                    <td></td>
                    <td></td>
                    <td class="detailModalCreditName align-middle text-center" width="25%">
                    <p class="ml-2">${v.category_name}</p>
                    <p>${kubun_name}</p>
                    </td>

                    <td class="detailModalCreditPrice align-middle" width="25%">
                        <input name="price[] id="" value="${v.price}" disabled>円
                        <br><p class="ml-2">${v.price}円</p>
                    </td>
                    </tr>`;
                }
                $('.detailModal').append(html);
            })
        }).fail(function () {
            alert('error...');
        });
    });
});

