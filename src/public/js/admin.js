//  checkboxの選択
$(function () {
    let status = false;
    var count = 0;
    $('#createSelect1').click(function () {
        // selectboxの表示・非表示
        $('.selectCategory').hide();
        $('.createCategory').show();
        $('#createCategory').prop('disabled', false);
        $('#selectCategory').prop('disabled', true);
        $('#kubunName').prop('disabled', true);
        //accountTypeのselectboxを編集
        $('#accountType0').show();
        $('#accountType').prop("selectedIndex", '');
        // selectCategoryのselectboxを編集と通信の可否判定
        status = false;
        $('#selectCategory').children().remove();
    });

    $('#createSelect2').click(function () {
        // selectboxの表示・非表示
        $('.selectCategory').hide();
        $('.createCategory').show();
        $('#createCategory').prop('disabled', false);
        $('#selectCategory').prop('disabled', true);
        $('#kubunName').prop('disabled', false);
        //accountTypeのselectboxを編集
        $('#accountType0').show();
        $('#accountType').prop("selectedIndex", '');
        // selectCategoryのselectboxを編集と通信の可否判定
        status = false;
        $('#selectCategory').children().remove();
    });

    $('#createSelect3').click(function () {
        // selectboxの表示・非表示
        $('.createCategory').hide()
        $('.selectCategory').show().css('display', 'inline-block');
        $('#createCategory').prop('disabled', true);
        $('#selectCategory').prop('disabled', false);
        $('#kubunName').prop('disabled', false);
        //accountTypeのselectboxを編集
        $('#accountType0').show();
        $('#accountType').prop("selectedIndex", '');
        // selectCategoryのselectboxを編集と通信の可否判定
        status = true;
        $('#selectCategory').children().remove();
        $('#selectCategory').prepend('<option value="" id="selectCategory0" selected>選択してください</option>');
    });

    $(document).on('change', `#accountType`, function () {
        if (status) {
            console.log('--- ajax ---');
            data = '';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: "/ajax/category_by_account",
                cache: false, // check
                data: {
                    account_type: $(this).val()
                },
            }).done(function (data) {
                console.log(data);
                $('#selectCategory').children().remove();

                $.each(data, function (k, v) {
                    $('#selectCategory').append($('<option>').text(v.category_name).attr('value', v.id));
                })

            }).fail(function () {
                alert('error!!!');
            });
        }
    });
});


// selectの選択
$(function () {
    $(document).on('change', `#accountType`, function () {
        $('#accountType0').hide();
    });

    $(document).on('change', `#accountType`, function () {
        $('#accountType0').hide();
    });

    $(document).on('change', `#selectCategory`, function () {
        $('#accountType0').hide();
        $('#selectCategory0').hide();

        // (kari) mada

    });
});
