/*  チャットルーム  */
let click = 0;

if ($('.view-mode').val() == 1) {
    for (let i = 1; i <= $('.list-size').val() ; i++) {
        $(`.btn-delete-${i}`).on('click', function() {
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/delete_chat_room',
                    dataType: 'json',
                    data: {
                        view_mode: $('.view-mode').val(),
                        id: $('.id').val(),
                        list_id: $(`.list-id-${i}`).val()
                    }
                }).done(function (res) {
                    $('.reload').submit();
                    click = 0;
                }).fail(function (res) {
                    alert(res.id + ':' + res.list_id);
                });
            }
        });
    }

    let now_room_size = 0;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'ajax/check_room_size',
        dataType: 'json',
        data: {
            view_mode: $('.view-mode').val(),
            id: $('.id').val(),
        }
    }).done(function (res) {
        now_room_size = res.room_size;
    }).fail(function (res) {
        alert('fail');
    });

    setInterval(function() {
        // 履歴外ユーザーからの受信お知らせ
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'ajax/check_room_size',
            dataType: 'json',
            data: {
                view_mode: $('.view-mode').val(),
                id: $('.id').val(),
            }
        }).done(function (res) {
            if (now_room_size != res.room_size && now_room_size < res.room_size)
                $('.chat-room-update-notice .alert').text(`履歴にないユーザーからの受信があります。確認するにはリロードするか再度ページに訪れてください`);
            now_room_size = res.room_size;
        }).fail(function (res) {
            alert('fail');
        });
        // 受信メッセージカウンター
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'ajax/check_chat_size',
            dataType: 'json',
            data: {
                view_mode: $('.view-mode').val(),
                id: $('.id').val(),
            }
        }).done(function (res) {
            if (window.matchMedia('(min-width: 1100px)').matches)
                margin_left = "10px";
            else if (window.matchMedia('(min-width: 769px)').matches)
                margin_left = "1vw";
            else
                margin_left = "2vw";

            let counter = new Array(res.chat_room_size);
            for (let i = 0; i < res.chat_room_size; i++) {
                counter[i] = 0;
                for (let j = 0; j < res.chat_data_size; j++) {
                    if (res.chat_data[j]['account_id'] == $(`.list-id-${i + 1}`).val())
                        counter[i]++;
                }
                if (counter[i] != 0)
                    $(`.counter-${i + 1}`).text('+' + counter[i]).css('margin-left', margin_left);
            }
        }).fail(function (res) {
            alert(res.id + ':' + res.list_id);
        });
    }, 50);
}
/*  チャット  */

function nl2br(str) {
    return str.replace(/[\n]/g, "<br />");
}

if ($('.view-mode').val() == 2) {
    let input_flg = 0;
    let send = 0;
    let click = 0;
    let now_chat_data_size = 0;

    $('textarea').on('focusin', function() {
        input_flg = 1;
    }).on('focusout', function() {
        input_flg = 0;
        if ($('textarea').val().length == 0)
            $('.alert-chat').text('');
    });

    $('.btn-send').on('click', function() {
        if (send == 1) {
            send = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/send_chat',
                    dataType: 'json',
                    data: {
                        view_mode: $('.view-mode').val(),
                        id: $('.id').val(),
                        list_id: $(`.list-id`).val(),
                        message: $('textarea').val()
                    }
                }).done(function (res) {
                    if (res.open == 1)
                        text = "既読";
                    else
                        text = "未読";
                    if (res.image_name == null)
                        image_name = "images/user_icon.png";
                    else
                        image_name = res.image_name;

                    $('textarea').val('');
                    $('.append').append(
                        "<div class='chat-text-content-wrapper-1'>" +
                            "<div style='display: flex; align-items: end;'>" +
                                "<div>" +
                                    "<p id='read-" + res.chat_id + "'>" + text + "</p>" +
                                    "<p>" + res.time + "</p>" +
                                "</div>" +
                                "<div class='chat-text-wrapper'>" +
                                    "<p>" + nl2br(res.message) + "</p>" +
                                "</div>" +
                            "</div>" +
                            "<div class='image-wrapper'>" +
                                "<img src='" + image_name + "'>" +
                            "</div>" +
                        "</div>"
                    );
                    $(window).scrollTop($(window).height() * 200);
                    click = 0;
                }).fail(function (res) {
                    alert(res.id + ':' + res.list_id);
                });
            }
        } else {
            if ($('textarea').val().length == 0)
                $('.alert-chat').text('未入力');
            else if ($('textarea').val().length > 1000)
                $('.alert-chat').text('制限字数を超えております');
        }
    });

    $('.btn-clear').on('click', function() {
        if (click == 0) {
            click = 1;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'ajax/clear_chat',
                dataType: 'json',
                data: {
                    view_mode: $('.view-mode').val(),
                    id: $('.id').val(),
                    list_id: $(`.list-id`).val(),
                }
            }).done(function (res) {
                $('.submit-clear').submit();
                click = 0;
            }).fail(function (res) {
                alert(res.id + ':' + res.list_id);
            });
        }
    });

    // バリデート
    setInterval(function() {
        if (input_flg == 1) {
            if ($('textarea').val().length == 0) {
                $('.alert-chat').text('未入力');
                send = 0;
            } else if ($('textarea').val().length > 1000) {
                $('.alert-chat').text('制限字数を超えております');
                send = 0;
            } else {
                $('.alert-chat').text('');
                send = 1;
            }
        }
    }, 2);

    // 既読チェック
    setInterval(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'ajax/check_read_chat',
            dataType: 'json',
            data: {
                view_mode: $('.view-mode').val(),
                id: $('.id').val(),
                list_id: $(`.list-id`).val(),
            }
        }).done(function (res) {
            for (let i = 0; i < res.chat_data.length; i++) {
                if (res.chat_data[i]['open'] == 1)
                    $(`#read-${res.chat_data[i]['id']}`).text('既読');
                else
                    $(`#read-${res.chat_data[i]['id']}`).text('未読');
            }
        }).fail(function (res) {
            alert('fail');
        });
    }, 50);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:'ajax/check_chat_size',
        dataType: 'json',
        data: {
            view_mode: $('.view-mode').val(),
            id: $('.id').val(),
            list_id: $(`.list-id`).val(),
            now_chat_data_size: now_chat_data_size
        }
    }).done(function (res) {
        now_chat_data_size = res.chat_data_size;
    }).fail(function (res) {
        alert('fail');
    });

    setInterval(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'ajax/check_chat_size',
            dataType: 'json',
            data: {
                view_mode: $('.view-mode').val(),
                id: $('.id').val(),
                list_id: $(`.list-id`).val(),
                now_chat_data_size: now_chat_data_size
            }
        }).done(function (res) {
            if (res.chat_data_size != now_chat_data_size && now_chat_data_size != 0) {
                $('.append').append(
                    "<div class='chat-text-content-wrapper-2'>" +
                        "<div class='image-wrapper'>" +
                            "<img src='" + res.image_name + "'>" +
                        "</div>" +
                        "<div style='display: flex; align-items: end;'>" +
                            "<div class='chat-text-wrapper'>" +
                                "<p>" + nl2br(res.message) + "</p>" +
                            "</div>" +
                            "<div>" +
                                "<p>" + res.time + "</p>" +
                            "</div>" +
                        "</div>" +
                    "</div>"
                );
                $(window).scrollTop($(window).height() * 200);
            } else {
                if (res.chat_data_size != now_chat_data_size) {
                    $('.append').append(
                        "<div class='chat-text-content-wrapper-2'>" +
                            "<div class='image-wrapper'>" +
                                "<img src='" + res.image_name + "'>" +
                            "</div>" +
                            "<div style='display: flex; align-items: end;'>" +
                                "<div class='chat-text-wrapper'>" +
                                    "<p>" + nl2br(res.message) + "</p>" +
                                "</div>" +
                                "<div>" +
                                    "<p>" + res.time + "</p>" +
                                "</div>" +
                            "</div>" +
                        "</div>"
                    );
                    $(window).scrollTop($(window).height() * 200);
                }
            }
            now_chat_data_size = res.chat_data_size;
        }).fail(function (res) {
            now_chat_data_size = 0;
        });
    }, 50);
}
