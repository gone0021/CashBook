//  checkboxの選択
$(function () {
    let ajax_flg = false;
    // ------------------------
    // admin create
    // ------------------------
    $('#createSelect1').click(function () {
        // selectboxの表示・非表示
        $('.createSelectCategory').hide();
        $('.createCategory').show();
        $('#createCategory').prop('disabled', false);
        $('#createSelectCategory').prop('disabled', true);
        // kubunの表示
        $('.createKubunName').hide();
        $('#createKubunName').prop('disabled', true);
        $('#createKubunName').prop('required', false);
        // accountTypeのselectboxを編集
        $('#option0').show().prop('selected', true);
        // categoryのリセット
        $('#createSelectCategory').prop('required', false);
        $('#createSelectCategory').children().remove();
        // ajaxの可否判定
        ajax_flg = false;
    });

    $('#createSelect2').click(function () {
        // selectboxの表示・非表示
        $('.createCategory').hide()
        $('.createSelectCategory').show().css('display', 'inline-block');
        $('#createCategory').prop('disabled', true);
        $('#createSelectCategory').prop('disabled', false);
        // kubunの表示非表示
        $('.createKubunName').show();
        $('#createKubunName').prop('disabled', false);
        $('#createKubunName').prop('required', true);
        // accountTypeのselectboxを編集
        $('#option0').show().prop('selected', true);
        // categoryのリセット
        $('#createSelectCategory').prop('required', true);
        $('#createSelectCategory').children().remove();
        $('#createSelectCategory').prepend('<option value="" id="option1" selected>---</option>');
        // ajaxの可否判定
        ajax_flg = true;
    });

    /**
     * 小科目でバリデーションエラーが返ってきた時
     */
    if ($('input[name=mode]:checked').val() == 2) {
        // selectboxの表示・非表示
        $('.createCategory').hide()
        $('.createSelectCategory').show().css('display', 'inline-block');
        $('#createCategory').prop('disabled', true);
        $('#createSelectCategory').prop('disabled', false);
        // kubunの表示非表示
        $('.createKubunName').show();
        $('#createKubunName').prop('disabled', false);
        $('#createKubunName').prop('required', true);
        // accountTypeのselectboxを編集
        $('#option0').show().prop('selected', true);
        // categoryのリセット
        $('#createSelectCategory').prop('required', true);
        $('#createSelectCategory').children().remove();
        $('#createSelectCategory').prepend('<option value="" id="option1" selected>---</option>');
        // ajaxの可否判定
        ajax_flg = true;
    }

    /**
     * バリデーションエラー時に共通項目の表示を編集
     */
    let change1 = 'is-invalid';
    let element1 = '#createAccountType';
    let checkAccountType1 = $(element1).hasClass(change1);
    // categoryのバリデーションエラー
    if ($('input[name=createValidateMsg]').val() == 'createCategory') {
        $('#createSelect1').click(function () {
            $('#createErrorAccountType').show();
            checkAndChangeElement(checkAccountType1, element1, change1, 1)
        })
        $('#createSelect2').click(function () {
            $('#createErrorAccountType').hide();
            checkAndChangeElement(checkAccountType1, element1, change1, 2)
        })
    }
    // kubunのバリデーションエラー
    if ($('input[name=createValidateMsg]').val() == 'createKubun') {
        $('#createSelect1').click(function () {
            $('#createErrorAccountType').hide();
            checkAndChangeElement(checkAccountType1, element1, change1, 2)
        })
        $('#createSelect2').click(function () {
            $('#createErrorAccountType').show();
            checkAndChangeElement(checkAccountType1, element1, change1, 1)
        })
    }

    /**
     * account_typeからcategoryを取得
     */
    $(document).on('change', `#createAccountType`, function () {
        if (ajax_flg) {
            // console.log('--- ajax category ---');
            var element = '#createSelectCategory';
            var val = $(this).val();
            $(element).children().remove();
            getCategory(element, val);
        }
    });

    /**
     * selectの編集
     */
    $('#createAccountType').change(function () {
        $('#option0').hide();
    });


    // ------------------------
    // admin edit
    // ------------------------
    $('#editSelect1').click(function () {
        // 見た目とinputのname属性
        $('.editCategoryName').show()
        $('#editCategoryName').prop({"required":true, "disabled":false});
        $('.editKubunName').hide();
        $('#editKubunName').prop({"required":false, "disabled":true});

        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', false);
        $('#editAccountDel').hide();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの非表示
        $('.editSelectKubun').hide();
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", true);
    });

    $('#editSelect2').click(function () {
        // 見た目とinputのname属性
        $('.editCategoryName').hide()
        $('#editCategoryName').prop({"required":false, "disabled":true});
        $('.editKubunName').show();
        $('#editKubunName').prop({"required":true, "disabled":false});

        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', false);
        $('#editAccountDel').hide();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        $('#option2').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの表示/非表示
        $('.editSelectKubun').show().css('display', 'inline-block').prop('required', true);
        // kubunのリセット
        $('#editSelectKubun').prop('required', true);
        $('#editSelectKubun').children().remove();
        $('#editSelectKubun').append($('<option>').text('---').attr({ 'id': 'option2', 'value': '' }));
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", true);
    });

    $('#editSelect3').click(function () {
        // 見た目とinputのname属性
        $('.editCategoryName').hide()
        $('#editCategoryName').prop({"required":false, "disabled":true});
        $('.editKubunName').hide()
        $('#editKubunName').prop({"required":false, "disabled":true});
        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', true);
        $('#editAccountDel').show();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの非表示
        $('.editSelectKubun').hide();
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", false);
    });

    $('#editSelect4').click(function () {
        // 見た目とinputのname属性
        $('.editCategoryName').hide()
        $('#editCategoryName').prop({"required":false, "disabled":true});
        $('.editKubunName').hide()
        $('#editKubunName').prop({"required":false, "disabled":true});;
        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', true);
        $('#editAccountDel').show();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        $('#option2').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの表示/非表示
        $('.editSelectKubun').show().css('display', 'inline-block').prop('required', true);
        // kubunのリセット
        $('#editSelectKubun').prop('required', true);
        $('#editSelectKubun').children().remove();
        $('#editSelectKubun').append($('<option>').text('---').attr({ 'id': 'option2', 'value': '' }));
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", false);
    });

    /**
     * バリデーションエラーが返ってきた時
     */
    // 小科目
    if ($('input[name=mode]:checked').val() == 2) {
        // 見た目とinputのname属性
        $('.editCategoryName').hide()
        $('#editCategoryName').prop({"required":false, "disabled":true});
        $('.editKubunName').show();
        $('#editKubunName').prop({"required":true, "disabled":false});
        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', false);
        $('#editAccountDel').hide();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        $('#option2').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの表示/非表示
        $('.editSelectKubun').show().css('display', 'inline-block').prop('required', true);
        $('.editSelectKubun').children().prop('required', true);
        // kubunのリセット
        $('#editSelectKubun').children().remove();
        $('#editSelectKubun').append($('<option>').text('---').attr({ 'id': 'option2', 'value': '' }));
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", true);
    }

    // 科目削除
    if ($('input[name=mode]:checked').val() == 3) {
        // 見た目とinputのname属性
        $('.editCategoryName').hide()
        $('#editCategoryName').prop({"required":false, "disabled":true});
        $('.editKubunName').hide()
        $('#editKubunName').prop({"required":false, "disabled":true});
        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', true);
        $('#editAccountDel').show();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの非表示
        $('.editSelectKubun').hide();
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", false);
    }

    // 小科目削除
    if ($('input[name=mode]:checked').val() == 4) {
        // 見た目とinputのname属性
        $('.editCategoryName').hide()
        $('#editCategoryName').prop({"required":false, "disabled":true});
        $('.editKubunName').hide()
        $('#editKubunName').prop({"required":false, "disabled":true});;
        // updateとdeleteの編集
        $('#editAccountUpdate').prop('disabled', true);
        $('#editAccountDel').show();
        // selectboxの編集を許可
        $('#option0').show().prop('selected', true);
        $('#option1').show().prop('selected', true);
        $('#option2').show().prop('selected', true);
        // categoryのリセット
        $('#editSelectCategory').children().remove();
        $('#editSelectCategory').append($('<option>').text('---').attr('value', ''));
        // kubunの表示/非表示
        $('.editSelectKubun').show().css('display', 'inline-block').prop('required', true);
        $('.editSelectKubun').children().prop('required', true);
        // kubunのリセット
        $('#editSelectKubun').children().remove();
        $('#editSelectKubun').append($('<option>').text('---').attr({ 'id': 'option2', 'value': '' }));
        // 削除ボタンの編集
        $('.btnDel').prop("disabled", false);
    }

    /**
     * バリデーションエラー時に共通項目の表示を編集
     */
    let change2 = 'is-invalid';
    let element2 = '#editAccountType';
    let checkAccountType2 = $(element2).hasClass(change2);
    let element3 = '#editSelectCategory';
    let checkCategory = $(element3).hasClass(change2);
    let element4 = '#editSelectKubun';
    let checkKubun = $(element4).hasClass(change2);

    // category
    if ($('input[name=editValidateMsg]').val() == 'editCategory') {
        // 科目区分
        $('#editSelect1').click(function () {
            $('#editErrorAccountType').show();
            $('#editErrorCategoryId').show();
            checkAndChangeElement(checkAccountType2, element2, change2, 1)
            checkAndChangeElement(checkCategory, element3, change2, 1)

        })
        $('#editSelect2,#editSelect3,#editSelect4').click(function () {
            $('#editErrorAccountType').hide();
            $('#editErrorCategoryId').hide();
            checkAndChangeElement(checkAccountType2, element2, change2, 2)
            checkAndChangeElement(checkCategory, element3, change2, 2)
        })
    }

    // kubun
    if ($('input[name=editValidateMsg]').val() == 'editKubun') {
        // 科目区分
        $('#editSelect2').click(function () {
            $('#editErrorAccountType').show();
            $('#editErrorCategoryId').show();
            $('#editErrorKubunId').show();
            checkAndChangeElement(checkAccountType2, element2, change2, 1)
            checkAndChangeElement(checkCategory, element3, change2, 1)
            checkAndChangeElement(checkKubun, element4, change2, 1)
        })
        $('#editSelect1,#editSelect3,#editSelect4').click(function () {
            $('#editErrorAccountType').hide();
            $('#editErrorCategoryId').hide();
            $('#editErrorKubunId').hide();
            checkAndChangeElement(checkAccountType2, element2, change2, 2)
            checkAndChangeElement(checkCategory, element3, change2, 2)
            checkAndChangeElement(checkKubun, element4, change2, 2)
        })
    }

    // category削除
    if ($('input[name=editValidateMsg]').val() == 'editCategoryDel') {
        // 科目区分
        $('#editSelect3').click(function () {
            $('#editErrorAccountType').show();
            $('#editErrorCategoryId').show();
            checkAndChangeElement(checkAccountType2, element2, change2, 1)
            checkAndChangeElement(checkCategory, element3, change2, 1)

        })
        $('#editSelect1,#editSelect2,#editSelect4').click(function () {
            $('#editErrorAccountType').hide();
            $('#editErrorCategoryId').hide();
            checkAndChangeElement(checkAccountType2, element2, change2, 2)
            checkAndChangeElement(checkCategory, element3, change2, 2)
        })
    }

    // kubunの削除
    if ($('input[name=editValidateMsg]').val() == 'editKubunDel') {
        // 科目区分
        $('#editSelect4').click(function () {
            $('#editErrorAccountType').show();
            $('#editErrorCategoryId').show();
            $('#editErrorKubunId').show();
            checkAndChangeElement(checkAccountType2, element2, change2, 1)
            checkAndChangeElement(checkCategory, element3, change2, 1)
            checkAndChangeElement(checkKubun, element4, change2, 1)
        })
        $('#editSelect1,#editSelect2,#editSelect3').click(function () {
            $('#editErrorAccountType').hide();
            $('#editErrorCategoryId').hide();
            $('#editErrorKubunId').hide();
            checkAndChangeElement(checkAccountType2, element2, change2, 2)
            checkAndChangeElement(checkCategory, element3, change2, 2)
            checkAndChangeElement(checkKubun, element4, change2, 2)
        })
    }

    /**
     * account_typeからcategoryを取得
     */
    $('#editAccountType').change(function () {
        // console.log('--- ajax category ---');
        var element = '#editSelectCategory';
        var val = $(this).val();
        $(element).children().remove();
        $(element).prepend($('<option>').text('---').attr({ 'id': 'option1', 'value': '' }));

        getCategory(element, val);
    });

    /**
     * categoryからkubunを取得
     */
    $('#editSelectCategory').change(function () {
        // console.log('--- ajax kubun ---');
        var element = '#editSelectKubun';
        var val = $(this).val();

        $(element).children().remove();
        getKubun(element, val);
    });

    /**
     * selectの編集
     */
    $('#editAccountType').change(function () {
        $('#option0').hide();
    });

    $('#editSelectCategory').change(function () {
        $('#option1').hide();
        $('#option2').hide();
    });


    // ------------------------
    // admin method
    // ------------------------
    /**
     * categoryの取得
     * @param {string} element
     * @param {number} val
     */
    function getCategory(element, val, error = null) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/ajax/category_by_account",
            data: { account_type: val, },
            dataType: 'json',
        }).done(function (ret) {
            // console.log(ret);
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
     * @param {number} val
     */
    function getKubun(element, val, error = null) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: `/ajax/kubun_by_category`,
            data: { category_id: val, },
            dataType: 'json',
        }).done(function (ret) {
            // console.log(ret);
            if (ret.length == 0) {
                $(element).append($('<option>').text("小科目なし").attr('value', 0));
                $(element).prop('required', false);
            } else {
                $.each(ret, function (k, v) {
                    $(element).append($(`<option>`).text(v.kubun_name).attr({ 'value': v.id, }))
                    $(element).prop('required', true);

                })
            }
        }).fail(function () {
            alert('error!! get kubun' + error);
        });
    }

    /**
     * check値の有無を確認してchangeのクラスを操作
     * @param {string} check
     * @param {string} element
     * @param {string} change
     * @param {number} type
     */
    function checkAndChangeElement(check, element, change, type) {
        if (check) {
            if (type == 1) {
                $(element).addClass(change);
            } else if (type == 2) {
                $(element).removeClass(change);
            }
        }
    }

});
