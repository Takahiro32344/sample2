/*  イベント  */

let input_flg = 0;
let update = 0;
let click = 0;

const param = new URLSearchParams(location.search);

$('.alert').css({'margin-top':'0', 'margin-bottom':'0'});

$('input').on('focusin', function() {
    input_flg = 1;
}).on('focusout', function() {
    input_flg = 0;
    if ($('.password').val().length == 0 && $('.password-retype').val().length == 0) {
        $('.alert').text('');
    }
});

$('.btn-setting').on('mouseout', function() {
    $(this).css({'transition':'.7s', 'color':'rgb(50,20,10)', 'background-color':'rgba(255,255,255,0)'});
}).on('mouseover', function() {
    $(this).css({'transition':'.7s', 'color':'white', 'background-color':'rgba(50,20,10,0.5)'});
});

$('.btn-setting').on('click', function() {
    if (update == 1) {
        update = 0;
        if (click == 0) {
            click = 1;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'ajax/reset_password',
                dataType: 'json',
                data: {
                    id_name: param.get("id_name"),
                    password: $('.password').val()
                }
            }).done(function (res){
                if (res.error == 0) {
                    $('input').val('');
                    $('.alert-password').text('パスワードを変更しました');
                } else {
                    $('input').val('');
                    $('.alert-password').text('アカウントが存在しません');
                }
                click = 0;
            }).fail(function() {
                alert('fail');
            });
        }
    } else {
        if ($('.password').val().length == 0)
            $('.alert-password').text('未入力');
        else if (!($('.password').val().length >= 8 && $('.password').val().length <= 50))
            $('.alert-password').text('制限字数外');
        else if (!$('.password').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/))
            $('.alert-password').text('無効の文字が含まれております');
        else if ($('.password').val() != $('.password-retype').val())
            $('.alert-password').text('確認用と不一致');

        if ($('.password-retype').val().length == 0)
            $('.alert-password-retype').text('未入力');
        else if (!($('.password-retype').val().length >= 8 && $('.password-retype').val().length <= 50))
            $('.alert-password-retype').text('制限字数外');
        else if (!$('.password-retype').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/))
            $('.alert-password-retype').text('無効の文字が含まれております');
    }
});


setInterval(function() {
    if (input_flg == 1)
        validate();
}, 2);
