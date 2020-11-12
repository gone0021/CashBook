// 削除アラート
$(function () {
    $('.btDel').click(function (e) {
        var message = [
            '削除します'
        ].join('\n')
        if (!window.confirm(message)) {
            e.preventDefault()
        }
    });
});
