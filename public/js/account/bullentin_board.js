/*  掲示板投稿フォームバリデート  */

let input_flg = 0;
let click = 0;
let post_flg = 0;

function nl2br(str) {
    return str.replace(/[\n]/g, "<br />");
}

$('textarea').on('focusin', function() {
    input_flg = 1;
}).on('focusout', function() {
    input_flg = 0;
    if ($('textarea').val().length == 0)
        $('.alert').text('');
});
// 投稿有無チェック
$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url:'ajax/check_bullentin_borad_size',
    dataType: 'json',
    data: {
        id: $('.id').val()
    }
}).done(function (res) {
    if (res.size == 0)
        $('.none-registed').text('投稿はありません');
    else
        $('.none-registed').text('');
}).fail(function (res) {
    alert('fail');
});

// 投稿
$('.btn-post').on('click', function() {
    if (post_flg == 1) {
        post_flg = 0;
        if (click == 0) {
            click = 1;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'ajax/post_personal_bullentin_borad',
                dataType: 'json',
                data: {
                    id: $('.id').val(),
                    text: $('textarea').val()
                }
            }).done(function (res) {
                $('.reload').submit();
                click = 0;
            }).fail(function (res) {
                alert('fail');
            });
        }
    } else {
        if ($('textarea').val().length == 0)
            $('.alert').text('未入力');
    }
});

// 全て削除
$('.btn-delete-all').on('click', function() {
    if (click == 0) {
        click = 1;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'ajax/delete_personal_bullentin_borad',
            dataType: 'json',
            data: {
                id: $('.id').val(),
                flg: 1
            }
        }).done(function (res) {
            $('.reload').submit();
            click = 0;
        }).fail(function (res) {
            alert('fail');
        });
    }
});

// 部分削除
for (let i = 1; i <= $('.size').val(); i++) {
    $(`.btn-delete-${i}`).on('click', function() {
        if (click == 0) {
            click = 1;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'ajax/delete_personal_bullentin_borad',
                dataType: 'json',
                data: {
                    post_id: $(`.post-id-${i}`).val(),
                    id: $('.id').val(),
                    flg: 2
                }
            }).done(function (res) {
                $('.reload').submit();
                click = 0;
            }).fail(function (res) {
                alert('fail');
            });
        }
    });
}

setInterval(function() {
    if (input_flg == 1) {
        if ($('textarea').val().length == 0) {
            $('.alert').text('未入力');
            post_flg = 0;
        } else if ($('textarea').val().length > 1000) {
            $('.alert').text('制限字数を超えております');
            post_flg = 0;
        } else {
            $('.alert').text('');
            post_flg = 1;
        }
    }
}, 2);

