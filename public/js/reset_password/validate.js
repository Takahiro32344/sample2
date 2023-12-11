/*  バリデート  */

let check = new Array(2);
check[0] = 0;
check[1] = 0;

function validate() {
    if ($('.password').val().length == 0) {
        $('.alert-password').text('未入力');
        check[0] = 0;
    } else if (!($('.password').val().length >= 8 && $('.password').val().length <= 50)) {
        $('.alert-password').text('制限字数外');
        check[0] = 0;
    } else if (!$('.password').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-password').text('無効の文字が含まれております');
        check[0] = 0;
    } else if ($('.password').val() != $('.password-retype').val()) {
        $('.alert-password').text('確認用と不一致');
        check[0] = 0;
    } else {
        $('.alert-password').text('');
        check[0] = 1;
    }

    if ($('.password-retype').val().length == 0) {
        $('.alert-password-retype').text('未入力');
        check[1] = 0;
    } else if (!($('.password-retype').val().length >= 8 && $('.password-retype').val().length <= 50)) {
        $('.alert-password-retype').text('制限字数外');
        check[1] = 0;
    } else if (!$('.password-retype').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-password-retype').text('無効の文字が含まれております');
        check[1] = 0;
    } else {
        $('.alert-password-retype').text('');
        check[1] = 1;
    }

    if (check[0] == 1 && check[1] == 1)
        update = 1;
    else
        update = 0;
}

