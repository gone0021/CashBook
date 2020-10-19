let title = '<input type="text" name="title[]" class="mr-2" required placeholder="title">';
let start = '<input type="date" name="start[]" class="mr-2" required>';
let end = '<input type="date" name="end[]" class="mr-2" required>';
let start_time = '<input type="time" name="start_time[]" class="mr-2" required>';
let end_time = '<input type="time" name="end_time[]" class="mr-2" required>';
let tag = '<select name="tag[]" id="" class="mr-2">' +
    '<option value="0">趣味</option>' +
    '<option value="1">付き合い</option>' +
    '<option value="2">仕事</option>' +
    '</select>';

let bt_del = '<button type="button" class="btCancel" >削除</button>';
let bt_new_meny = '<input type="submit" name="_post_meny" value="new_meny" class="mb-2 add" id="tbtNew">';
let bt_edit = '<button type="button" value="編集">';

let inp_new = '<div class="mb-2 add">' + title + start + start_time + end
    + end_time + tag + bt_del + '</div>';

let new_flag = false;
let modal_flag = false;

$(function () {
    // 追加ボタン
    $("#btAdd").click(function () {
        // submitは一回だけのため有無をflagで判定する
        if (new_flag == false) {
            new_flag = true;
            $('#new').append(bt_new_meny);
        }
        $('#new').prepend(inp_new);
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


    // 新規：支出
    $("#newExpense").click(function () {
        $(".glayLayer").fadeIn();
        $("#expenseModal").fadeIn();
    });

    // 新規：収入
    $("#newIncome").click(function () {
        $(".glayLayer").fadeIn();
        $("#incomeModal").fadeIn();
    });

    // 新規：簿記風
    $("#newAccount").click(function () {
        $(".glayLayer").fadeIn();
        $("#accountModal").fadeIn();
    });

    // モーダル背景
    $(".glayLayer").click(function () {
        $(this).fadeOut()
        $("#expenseModal").fadeOut();
        $("#incomeModal").fadeOut();
        $("#accountModal").fadeOut();
    });

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
