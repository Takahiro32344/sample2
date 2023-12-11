/*  バリデート  */

function validate() {
    switch ($('.view-mode').val()) {
        case '1':
            if ($('.id-name').val().length == 0 && $('.password').val().length == 0) {
                $('.alert').text("IDとパスワードが未入力");
                error_validate = 1;
            } else if ($('.id-name').val().length == 0 && $('.password').val().length != 0) {
                $('.alert').text("IDが未入力");
                error_validate = 1;
            } else if ($('.id-name').val().length != 0 && $('.password').val().length == 0) {
                $('.alert').text("パスワードが未入力");
                error_validate = 1;
            } else {
                $('.alert').text("");
                error_validate = 0;
            }
            break;
        case '2':
            if ($('.answer').val().length == 0) {
                $('.alert').text("未入力");
                error_validate = 1;
            } else {
                $('.alert').text("");
                error_validate = 0;
            }
            break;
        case '3':
            if ($('.code').val().length == 0) {
                $('.alert').text("未入力");
                error_validate = 1;
            } else if ($('.code').val().length != 8) {
                $('.alert').text("8桁入力してください");
                error_validate = 1;
            } else if (!$('.code').val().match(/^[0-9]+$/)) {
                $('.alert').text("無効の文字が含まれております");
                error_validate = 1;
            } else {
                $('.alert').text("");
                error_validate = 0;
            }
            break;
        case '4':
            if ($('.regist-email').val().length == 0) {
                $('.alert').text('未入力');
                error_validate = 1;
            } else if ($('.regist-email').val().length > 50) {
                $('.alert').text('制限字数を超えております');
                error_validate = 1;
            } else if (!$('.regist-email').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
                $('.alert').text('無効の文字が含まれております');
                error_validate = 1;
            } else if (!($('.regist-email').val().match(/^[A-Za-z0-9.]+[\w-]+@[\w\.-]+\.\w{2,}$/))) {
                $('.alert').text('入力形式が正しくありません');
                error_validate = 1;
            } else {
                $('.alert').text('');
                error_validate = 0;
            }
            break;
    }
}

