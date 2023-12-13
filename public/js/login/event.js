/*  イベント処理  */

// 入力欄
let input_flg = 0;
let click = 0;

$('input').on('focusin', function() {
    input_flg = 1;
    $('.alert-return').text("");
}).on('focusout', function() {
    input_flg  = 0;
    if ($('.view-mode').val() == 1) {
        if ($('.id-name').val().length == 0 && $('.password').val().length == 0)
            $('.alert').text("");
    } else if ($('.view-mode').val() == 2) {
        if ($('.answer').val().length == 0)
            $('.alert').text("");
    } else if ($('.view-mode').val() == 3) {
        if ($('.code').val().length == 0)
            $('.alert').text("");
    } else if ($('.view-mode').val() == 4) {
        if ($('.regist-email').val().length == 0)
            $('.alert').text("");
    }
});

// マウス
$('.btn-create-account').on('mouseout', function() {
    $(this).css({'transition':'.7s', 'color':'rgb(50,20,10)', 'background-color':'rgba(255,255,255,0)'});
}).on('mouseover', function() {
    $(this).css({'transition':'.7s', 'color':'white', 'background-color':'rgba(50,20,10,0.5)'});
});

$('.btn-login').on('mouseout', function() {
    $(this).css({'transition':'.7s', 'color':'rgb(50,20,10)', 'background-color':'rgba(255,255,255,0)'});
}).on('mouseover', function() {
    $(this).css({'transition':'.7s', 'color':'white', 'background-color':'rgba(50,20,10,0.5)'});
});

$('.btn-return').on('mouseout', function() {
    $(this).css({'transition':'.7s', 'color':'rgb(50,20,10)', 'background-color':'rgba(255,255,255,0)'});
}).on('mouseover', function() {
    $(this).css({'transition':'.7s', 'color':'white', 'background-color':'rgba(50,20,10,0.5)'});
});

// クリック
let error_validate = 1;

$('.btn-login').on('click', function() {
    switch ($('.view-mode').val()) {
        case '1':
            if (error_validate == 0) {
                if (click == 0) {
                    click = 1;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        url:'ajax/login_check_1',
                        dataType: 'json',
                        data: {
                            'id_name': $('.id-name').val(),
                            'password': $('.password').val()
                        }
                    }).done(function (res){
                        switch (res.error) {
                            case 0:
                                switch (res.certification) {
                                    case 0:
                                        $('.post-id-name').val($('.id-name').val());
                                        $('.post-password').val($('.password').val());
                                        $('.login-1').submit();
                                        break;
                                    case 1:
                                        $('.post-id-name').val($('.id-name').val());
                                        $('.post-password').val($('.password').val());
                                        $('.login-2').submit();
                                        break;
                                    case 2:
                                        $('.post-id-name').val($('.id-name').val());
                                        $('.post-password').val($('.password').val());
                                        $('.login-3').submit();
                                        break;
                                }
                                break;
                            case 1:
                                $('.alert').text("アカウントが存在しません");
                                break;
                            case 2:
                                $('.alert').text("パスワードが正しくありません");
                                break;
                        }
                        click = 0;
                    });
                }
            } else {
                if ($('.id-name').val().length == 0 && $('.password').val().length == 0)
                    $('.alert').text("IDとパスワードが未入力");
                else if ($('.id-name').val().length == 0)
                    $('.alert').text("IDが未入力");
                else if ($('.password').val().length == 0)
                    $('.alert').text("パスワードが未入力");

                click = 0;
            }
            break;
        case '2':
            if (error_validate == 0) {
                if (click == 0) {
                    click = 1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/login_check_2',
                    dataType: 'json',
                    data: {
                        'id_name': $('.id-name').val(),
                        'answer': $('.answer').val()
                    }
                }).done(function (res){
                    switch (res.error) {
                        case 0:
                            $('.post-id-name').val($('.id-name').val());
                            $('.login-question').submit();
                            break;
                        case 1:
                            $('.alert').text("答えが正しくありません");
                            break;
                    }
                    click = 0;
                });
            } else {
                if ($('.answer').val().length == 0)
                    $('.alert').text("未入力");
                else
                    $('.alert').text("");
            }
            break;
        case '3':
            if (error_validate == 0) {
                if (click == 0) {
                    click = 1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/login_check_3',
                    dataType: 'json',
                    data: {
                        'id_name': $('.id-name').val(),
                        'code': $('.code').val()
                    }
                }).done(function (res){
                    switch (res.error) {
                        case 0:
                            $('.post-id-name').val($('.id-name').val());
                            $('.login-code').submit();
                            break;
                        case 1:
                            $('.alert').text("コードが正しくありません");
                            break;
                    }
                    click = 0;
                }).fail(function() {
                    alert($('.id-name').val() + ' : ' + $('.code').val());
                });
            } else {
                if ($('.answer').val().length == 0)
                    $('.alert').text("未入力");
                else
                    $('.alert').text("");
            }
            break;
        case '4':
            if (error_validate == 0) {
                if (click == 0) {
                    click = 1;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/send_email',
                    dataType: 'json',
                    data: {
                        'regist_email': $('.regist-email').val()
                    }
                }).done(function (res){
                    if (res.error == 0)
                        $('.alert').text('メールを送信しました');
                    else
                        $('.alert').text('メールを送信できませんでした');
                    click = 0;
                });
            } else {
                if ($('.regist-email').val().length == 0)
                    $('.alert').text('未入力');
                else if ($('.regist-email').val().length > 50)
                    $('.alert').text('制限字数を超えております');
                else if (!$('.regist-email').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/))
                    $('.alert').text('無効の文字が含まれております');
                else if (!($('.regist-email').val().match(/^[A-Za-z0-9.]+[\w-]+@[\w\.-]+\.\w{2,}$/)))
                    $('.alert').text('入力形式が正しくありません');
            }
            break;
    }
});

let set_flg = 0;
// タイマー処理
setInterval(function() {
    // 入力欄
    if (input_flg == 1)
        validate();

}, 2);

