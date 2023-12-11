/*  バリデート  */

function validate() {
    // セレクト
    if ($('.birth-year').val() == '未選択') {
        $('.birth-year').css('color', 'red');
    } else {
        $('.birth-year').css('color', 'black');
    }

    if ($('.birth-month').val() == '未選択') {
        $('.birth-month').css('color', 'red');
    } else {
        $('.birth-month').css('color', 'black');
    }

    if ($('.birth-day').val() == '未選択') {
        $('.birth-day').css('color', 'red');
    } else {
        $('.birth-day').css('color', 'black');
    }

    if ($('.gender').val() == '未選択') {
        $('.gender').css('color', 'red');
    } else {
        $('.gender').css('color', 'black');
    }

    if ($('.address-1').val() == '未選択') {
        $('.address-1').css('color', 'red');
    } else {
        $('.address-1').css('color', 'black');
    }

    // 住所
    if ($('.address-2').val().length == 0) {
        $('.alert-address-2').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if ($('.address-2').val().length > 15) {
        $('.alert-address-2').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else {
        $('.alert-address-2').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
    }

    // 氏名
    if ($('.name').val().length == 0) {
        $('.alert-name').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if ($('.name').val().length > 15) {
        $('.alert-name').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else {
        $('.alert-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
    }

    // ID
    if ($('.id-name').val().length == 0) {
        $('.alert-id-name').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if ($('.id-name').val().length > 50) {
        $('.alert-id-name').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!$('.id-name').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-id-name').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else {
        $('.alert-id-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
    }

    // メール
    if ($('.mail').val().length == 0) {
        $('.alert-mail').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if ($('.mail').val().length > 50) {
        $('.alert-mail').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!$('.mail').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-mail').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!($('.mail').val().match(/^[A-Za-z0-9.]+[\w-]+@[\w\.-]+\.\w{2,}$/))) {
        $('.alert-mail').text('入力形式が正しくありません').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else {
        $('.alert-mail').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
    }

    // パスワード
    if ($('.password').val().length == 0) {
        $('.alert-password').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!($('.password').val().length >= 8 && $('.password').val().length <= 50)) {
        $('.alert-password').text('制限字数外です').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!$('.password').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-password').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if ($('.password').val() != $('.password-retype').val()) {
        $('.alert-password').text('確認用と不一致').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else {
        $('.alert-password').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
    }

    // パスワード(確認用)
    if ($('.password-retype').val().length == 0) {
        $('.alert-password-retype').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!($('.password-retype').val().length >= 8 && $('.password-retype').val().length <= 50)) {
        $('.alert-password-retype').text('制限字数外です').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else if (!$('.password-retype').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-password-retype').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
    } else {
        $('.alert-password-retype').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
    }
}

function validate_realtime() {
    var flg = new Array(11);
    var counter = 0;
    // セレクト
    if ($('.birth-year').val() == '未選択') {
        $('.birth-year').css('color', 'red');
        flg[0] = 0;
    } else {
        $('.birth-year').css('color', 'black');
        flg[0] = 1;
    }

    if ($('.birth-month').val() == '未選択') {
        $('.birth-month').css('color', 'red');
        flg[1] = 0;
    } else {
        $('.birth-month').css('color', 'black');
        flg[1] = 1;
    }

    if ($('.birth-day').val() == '未選択') {
        $('.birth-day').css('color', 'red');
        flg[2] = 0;
    } else {
        $('.birth-day').css('color', 'black');
        flg[2] = 1;
    }

    if ($('.gender').val() == '未選択') {
        $('.gender').css('color', 'red');
        flg[3] = 0;
    } else {
        $('.gender').css('color', 'black');
        flg[3] = 1;
    }

    if ($('.address-1').val() == '未選択') {
        $('.address-1').css('color', 'red');
        flg[4] = 0;
    } else {
        $('.address-1').css('color', 'black');
        flg[4] = 1;
    }

    // 住所
    if ($('.address-2').val().length == 0) {
        $('.alert-address-2').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[5] = 0;
    } else if ($('.address-2').val().length > 15) {
        $('.alert-address-2').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[5] = 0;
    } else {
        $('.alert-address-2').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
        flg[5] = 1;
    }

    // 氏名
    if ($('.name').val().length == 0) {
        $('.alert-name').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[6] = 0;
    } else if ($('.name').val().length > 15) {
        $('.alert-name').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[6] = 0;
    } else {
        $('.alert-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
        flg[6] = 1;
    }

    // ID
    if ($('.id-name').val().length == 0) {
        $('.alert-id-name').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[7] = 0;
    } else if ($('.id-name').val().length > 50) {
        $('.alert-id-name').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[7] = 0;
    } else if (!$('.id-name').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-id-name').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[7] = 0;
    } else {
        $('.alert-id-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
        flg[7] = 1;
    }

    // メール
    if ($('.mail').val().length == 0) {
        $('.alert-mail').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[8] = 0;
    } else if ($('.mail').val().length > 50) {
        $('.alert-mail').text('制限字数を超えております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[8] = 0;
    } else if (!$('.mail').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-mail').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[8] = 0;
    } else if (!($('.mail').val().match(/^[A-Za-z0-9.]+[\w-]+@[\w\.-]+\.\w{2,}$/))) {
        $('.alert-mail').text('入力形式が正しくありません').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[8] = 0;
    } else {
        $('.alert-mail').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
        flg[8] = 1;
    }

    // パスワード
    if ($('.password').val().length == 0) {
        $('.alert-password').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[9] = 0;
    } else if (!($('.password').val().length >= 8 && $('.password').val().length <= 50)) {
        $('.alert-password').text('制限字数外です').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[9] = 0;
    } else if (!$('.password').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-password').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[9] = 0;
    } else if ($('.password').val() != $('.password-retype').val()) {
        $('.alert-password').text('確認用と不一致').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[9] = 0;
    } else {
        $('.alert-password').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
        flg[9] = 1;
    }

    // パスワード(確認用)
    if ($('.password-retype').val().length == 0) {
        $('.alert-password-retype').text('未入力').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[10] = 0;
    } else if (!($('.password-retype').val().length >= 8 && $('.password-retype').val().length <= 50)) {
        $('.alert-password-retype').text('制限字数外です').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[10] = 0;
    } else if (!$('.password-retype').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
        $('.alert-password-retype').text('無効な文字が含まれております').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
        flg[10] = 0;
    } else {
        $('.alert-password-retype').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size': '0'});
        flg[10] = 1;
    }

    for (i = 0; i < 11; i++) {
        if (flg[i] == 1)
            counter++;
    }

    if (counter == 11)
        error_validate = 0;
    else
        error_validate = 1;
}

