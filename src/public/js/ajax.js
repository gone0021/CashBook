$(function () {
    /**
     * 支出モーダル
     */
    // 資産区分
    $("#expenseModalAssetCategory").change(function () {
        // alert('ajax');
        $('#expenseModalAssetKubun option').remove();
        $('.selectFormatExpenseAccet').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/modal/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                $('#expenseModalAssetKubun').append($('<option>').text("小区分なし").attr('value','null'));
            } else {
                $.each(data, function (k, v) {
                    $('#expenseModalAssetKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });

    // 費用区分
    $("#expenseModalCostCategory").change(function () {
        // alert('ajax');
        $('#expenseModalCostKubun option').remove();
        $('.selectFormatExpenseCost').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/modal/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                $('#expenseModalCosttKubun').append($('<option>').text("小区分なし").attr('value','null'));
            } else {
                $.each(data, function (k, v) {
                    $('#expenseModalCostKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });

    });

    /**
     * 収入モーダル
     */
    // 資産区分
    $("#incomeModalAssetCategory").change(function () {
        // alert('ajax');
        $('#incomeModalAssetKubun option').remove();
        $('.selectFormatIncomeAccet').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/modal/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                $('#incomeModalAssetKubun').append($('<option>').text("小区分なし").attr('value','null'));
            } else {
                $.each(data, function (k, v) {
                    $('#incomeModalAssetKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });

    // 費用区分
    $("#incomeModalCostCategory").change(function () {
        // alert('ajax');
        $('#incomeModalCostKubun option').remove();
        $('.selectFormatIncomeCost').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/modal/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                $('#incomeModalCosttKubun').append($('<option>').text("小区分なし").attr('value','null'));
            } else {
                $.each(data, function (k, v) {
                    $('#incomeModalCostKubun').append($('<option>').text(v.kubun_name).attr('value', v.id));
                })
            }
        }).fail(function () {
            alert('error!!!');
        });
    });

    /**
     * 簿記風モーダル
     */
    // 借方
    $("#accountModalDebitCategory").change(function () {
        // alert('ajax');
        $('#accountModalDebitKubun option').remove();
        $('.selectFormatDebit').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/modal/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                $('#accountModalDebitKubun').append($('<option>').text("小区分なし").attr('value', 'null'));
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
            url: "/modal/kubun",
            data: {
                id: $(this).val()
            }
        }).done(function (data) {
            if (data.length == 0) {
                $('#accountModalCreditKubun').append($('<option>').text("小区分なし").attr('value','null'));
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

