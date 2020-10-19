$(function() {
    //
    $('.bt-edit').click(function() {
        var edit = $('.bt-edit').val();
        $.ajax({
            type: "GET",
            url: "./edit.php",
            data: {
                id: edit
            },
            //Ajax通信が成功した場合に呼び出されるメソッド
            success: function(data) {
                $('#m-title').val(data.title);
                $('#m-start').val(data.start);
                $('#m-end').val(data.end);
                $('#m-tag').val(data.tag);
                $('#m-memo').val(data.memo);
            }
        });
    });
});
