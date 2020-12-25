// 削除アラート
$(function () {
    $('.btnDel').click(function (e) {
        var message = [
            '削除してもよろしいですか？'
        ].join('\n')
        if (!window.confirm(message)) {
            e.preventDefault()
        }
    });
});
