/*  イベント処理  */

if (window.matchMedia('(min-width: 1100px)').matches) {
    width = "40px";
    margin_top_1 = "1px";
    margin_top_2 = "1px";
    font_size = "22px";
    margin_top_alert = "0px";
    margin_bottom_alert = "5px";
    margin_bottom_input = "20px";
} else if (window.matchMedia('(min-width: 769px)').matches) {
    width = "4vw";
    margin_top_1 = "0vw";
    margin_top_2 = "0vw";
    font_size = "2.2vw";
    margin_top_alert = "2vw";
    margin_bottom_alert = "0vw";
} else {
    width = "8vw";
    margin_top_1 = "0.4vw";
    margin_top_2 = "0.4vw";
    font_size = "3.2vw";
    margin_top_alert = "5vw";
    margin_bottom_alert = "5vw";
}

// 入力欄
let input_flg = 0;
let click = 0;

$('select').on('focusin', function() {
    input_flg = 1;
    $('.alert-created').text('');
}).on('focusout', function() {
    input_flg = 0;
    $('.alert-created').text('');
    if ($('.birth-year').val() == '未選択' && $('.birth-month').val() == '未選択' && $('.birth-day').val() == '未選択' && $('.gender').val() == '未選択' &&
        $('.address-1').val() == '未選択' && $('.address-2').val().length == 0 && $('.name').val().length == 0 && $('.id-name').val().length == 0 && $('.mail').val().length == 0 &&
        $('.password').val().length == 0 && $('.password-retype').val().length == 0) {
        $('select').css('color', 'black');
        $('input').css('margin-bottom', margin_bottom_input);
        $('.alert-address-2').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-id-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-mail').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-password').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-password-retype').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
    }
});

$('input').on('focusin', function() {
    $('.alert-created').text('');
    input_flg = 1;
}).on('focusout', function() {
    input_flg = 0;
    $('.alert-created').text('');
    if ($('.birth-year').val() == '未選択' && $('.birth-month').val() == '未選択' && $('.birth-day').val() == '未選択' && $('.gender').val() == '未選択' &&
        $('.address-1').val() == '未選択' && $('.address-2').val().length == 0 && $('.name').val().length == 0 && $('.id-name').val().length == 0 && $('.mail').val().length == 0 &&
        $('.password').val().length == 0 && $('.password-retype').val().length == 0) {
        $('select').css('color', 'black');
        $('input').css('margin-bottom', '0');
        $('.alert-address-2').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-id-name').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-mail').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-password').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
        $('.alert-password-retype').text('').css({'margin-top':'0', 'margin-bottom':'0', 'font-size':'0'});
    }
});

// ボタン
let flg_mouse = 0;

// マウスアウト
$('.btn-create-account').on('mouseout', function() {
    $('button .margin-top-1').css('margin-top', margin_top_1);
    $('button .margin-top-2').css('margin-top', margin_top_2);
    $(this).css({'transition':'.7s', 'color':'rgb(50,20,10)', 'background-color':'rgba(255,255,255,0)'});
    $('.u-line-1').css({'transition':'.7s', 'margin':'0 auto', 'width':'0', 'height':'1px', 'background-color':'rgba(50,20,10,0,4)'});
});

$('.btn-create').on('mouseout', function() {
    $('button .margin-top-1').css('margin-top', margin_top_1);
    $('button .margin-top-2').css('margin-top', margin_top_2);
    $(this).css({'transition':'.7s', 'color':'rgb(50,20,10)', 'background-color':'rgba(255,255,255,0)'});
    $('.u-line-2').css({'transition':'.7s', 'margin':'0 auto', 'width':'0', 'height':'1px', 'background-color':'rgba(50,20,10,0,4)'});
});

// マウスオーバー
$('.btn-create-account').on('mouseover', function() {
    $('button .margin-top-1').css('margin-top', margin_top_1);
    $('button .margin-top-2').css('margin-top', margin_top_2);
    $(this).css({'transition':'.7s', 'color':'white', 'background-color':'rgba(50,20,10,0.5)'});
    $('.u-line-1').css({'transition':'.7s', 'margin':'0 auto', 'width': width, 'height':'1px', 'background-color':'white'});
});

$('.btn-create').on('mouseover', function() {
    $('button .margin-top-1').css('margin-top', margin_top_1);
    $('button .margin-top-2').css('margin-top', margin_top_2);
    $(this).css({'transition':'.7s', 'color':'white', 'background-color':'rgba(50,20,10,0.5)'});
    $('.u-line-2').css({'transition':'.7s', 'margin':'0 auto', 'width': width, 'height':'1px', 'background-color':'white'});
});

// クリック
let error_validate = 1;

$('.btn-create').on('click', function() {
    if (error_validate == 0) {
        if (click == 0) {
            click = 1;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'ajax/create_check',
                dataType: 'json',
                data: {
                    'birth_year': $('.birth-year').val(),
                    'birth_month': $('.birth-month').val(),
                    'birth_day': $('.birth-day').val(),
                    'gender': $('.gender').val(),
                    'address_1': $('.address-1').val(),
                    'address_2': $('.address-2').val(),
                    'name': $('.name').val(),
                    'id_name': $('.id-name').val(),
                    'mail': $('.mail').val(),
                    'password': $('.password').val()
                }
            }).done(function (res){
                switch (res.error) {
                    case 0:
                        $('select').val('未選択').css('color', 'black');
                        $('input').val('');
                        $('.alert-created').text('アカウントを作成しました');
                        error_validate = 1;
                        break;
                    case 1:
                        $('.alert-id-name').text('既に使用されています').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
                        $('.alert-mail').text('既に使用されています').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
                        break;
                    case 2:
                        $('.alert-id-name').text('既に使用されています').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
                        break;
                    case 3:
                        $('.alert-mail').text('既に使用されています').css({'margin-top': margin_top_alert, 'margin-bottom': margin_bottom_alert, 'font-size': font_size});
                        break;
                }
                click = 0;
            }).fail(function() {
                alert();
            });
        }
    } else {
        $('.alert-created').text('');
        validate();
    }
});

// タイマー処理
setInterval(function() {
    if (window.matchMedia('(min-width: 1100px)').matches) {
        width = "40px";
        margin_top_1 = "1px";
        margin_top_2 = "1px";
        font_size = "22px";
        margin_top_alert = "20px";
        margin_bottom_alert = "-10px";
        margin_bottom_input = "20px";
    } else if (window.matchMedia('(min-width: 769px)').matches) {
        width = "4vw";
        margin_top_1 = "0vw";
        margin_top_2 = "0vw";
        font_size = "2.2vw";
        margin_top_alert = "2vw";
        margin_bottom_alert = "-1vw";
        margin_bottom_input = "2vw";
    } else {
        width = "8vw";
        margin_top_1 = "0.4vw";
        margin_top_2 = "0.4vw";
        font_size = "3.2vw";
        margin_top_alert = "2vw";
        margin_bottom_alert = "-1vw";
        margin_bottom_input = "2vw";
    }

    // 入力欄
    if (input_flg == 1)
        validate_realtime();

    $('input').css('margin-bottom', margin_bottom_input);

    // ボタン
    $('button .margin-top-1').css('margin-top', margin_top_1);
    $('button .margin-top-2').css('margin-top', margin_top_2);
}, 2);

