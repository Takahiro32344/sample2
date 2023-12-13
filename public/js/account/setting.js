/*  設定画面  */

let click = 0;

// アカウント削除
$('.btn-delete-account').on('click', function() {
    if (click == 0) {
        click = 1;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'ajax/delete_account',
            dataType: 'json',
            data: {
                id: $('.id').val(),
                id_name: $('.id-name').val()
            }
        }).done(function () {
            $('.delete-account-submit').submit();
            click = 0;
        }).fail(function () {
            alert($('.id-name').val() + ' : ' + $('.id').val());
        });
    }
});

// バリデート
let input_flg = 0;
let update_password = 0;
let check = new Array(2);
check[0] = 0;
check[1] = 0;

if ($('.view-mode').val() == 3) {
    if (window.matchMedia('(max-width: 769px)').matches)
        device_no = 2;
    else
        device_no = 1;

        let update = new Array(8);
    let input = new Array(12);
    for (i = 0; i < 8; i++)
        update[i] = 0;

    for (i = 0; i < 12; i++)
        input[i] = 0;

    let check_birth = new Array(3);
    for (i = 0; i < 3; i++)
        check_birth[i] = 0;

    let check_address = new Array(2);
    check_address[0] = 0;
    check_address[1] = 0;

    let check_publish = new Array(2);
    check_publish[0] = 0;
    check_publish[1] = 0;

    let check_double_lock = new Array(3);
    for (i = 0; i < 3; i++)
        check_double_lock[i] = 0;

    $('select').on('focusin', function() {
        $('.alert').text('');
        $('.alert-success').text('');
    }).on('focusout', function() {
        if ($('select').val() == "未選択")
            $('select').css('color', 'black');
        if ($('.edit-address-2').val().length == 0)
            $('.alert-address').text('');
        if ($('.edit-name').val().length == 0)
            $('.alert-name').text('');
        if ($('.edit-email').val().length == 0)
            $('.alert-email').text('');
        if ($('.edit-tel').val().length == 0)
            $('.alert-tel').text('');
        if ($('.question').val().length == 0)
            $('.alert-question').text('');
        if ($('.answer-PC').val().length == 0)
            $('.alert-answer').text('');
        if ($('.answer-Phone').val().length == 0)
            $('.alert-answer').text('');
    });

    $('input').on('focusin', function() {
        $('.alert').text('');
        $('.alert-success').text('');
    }).on('focusout', function() {
        if ($('select').val() == "未選択")
            $('select').css('color', 'black');
        if ($('.edit-address-2').val().length == 0)
            $('.alert-address').text('');
        if ($('.edit-name').val().length == 0)
            $('.alert-name').text('');
        if ($('.edit-email').val().length == 0)
            $('.alert-email').text('');
        if ($('.edit-tel').val().length == 0)
            $('.alert-tel').text('');
        if ($('.question').val().length == 0)
            $('.alert-question').text('');
        if ($('.answer-PC').val().length == 0)
            $('.alert-answer').text('');
        if ($('.answer-Phone').val().length == 0)
            $('.alert-answer').text('');
    });

    $('button').on('click', function() {
        $('.alert-success').text('');
    });

    // 生年月日
    $('.edit-year').on('focusin', function() {
        input[0] = 1;
    }).on('focusout', function() {
        input[0] = 0;
        $('select').css('color', 'black');
    });

    $('.edit-month').on('focusin', function() {
        input[0] = 1;
    }).on('focusout', function() {
        input[0] = 0;
        $('select').css('color', 'black');
    });

    $('.edit-day').on('focusin', function() {
        input[0] = 1;
    }).on('focusout', function() {
        input[0] = 0;
        $('select').css('color', 'black');
    });

    // 住所
    $('.edit-address-1').on('focusin', function() {
        input[1] = 1;
    }).on('focusout', function() {
        input[1] = 0;
        $('select').css('color', 'black');
    });

    $('.edit-address-2').on('focusin', function() {
        input[1] = 1;
    }).on('focusout', function() {
        input[1] = 0;
        $('select').css('color', 'black');
    });

    // 氏名
    $('.edit-name').on('focusin', function() {
        input[2] = 1;
    }).on('focusout', function() {
        input[2] = 0;
        $('select').css('color', 'black');
    });

    // メール
    $('.edit-email').on('focusin', function() {
        input[3] = 1;
    }).on('focusout', function() {
        input[3] = 0;
        $('select').css('color', 'black');
    });

    // 電話
    $('.edit-tel').on('focusin', function() {
        input[4] = 1;
    }).on('focusout', function() {
        input[4] = 0;
        $('select').css('color', 'black');
    });

    // 公開設定（メール）
    $('.publish-email').on('focusin', function() {
        input[5] = 1;
    }).on('focusout', function() {
        input[5] = 0;
        $('select').css('color', 'black');
    });

    // 公開設定（電話）
    $('.publish-tel').on('focusin', function() {
        input[5] = 1;
    }).on('focusout', function() {
        input[5] = 0;
        $('select').css('color', 'black');
    });

    // 2要素認証
    $('.setting-double-lock').on('focusin', function() {
        input[6] = 1;
    }).on('focusout', function() {
        input[6] = 0;
        $('select').css('color', 'black');
    });

    $('.question').on('focusin', function() {
        input[6] = 1;
    }).on('focusout', function() {
        input[6] = 0;
        $('select').css('color', 'black');
    });

    $('.answer-PC').on('focusin', function() {
        input[6] = 1;
    }).on('focusout', function() {
        input[6] = 0;
        $('select').css('color', 'black');
    });

    $('.answer-Phone').on('focusin', function() {
        input[6] = 1;
    }).on('focusout', function() {
        input[6] = 0;
        $('select').css('color', 'black');
    });

    if ($('.reload').val() == '1')
        $('.reload-form').submit();
    // 変更ボタン
    $('.btn-edit-1').on('click', function() {
        if (click == 0) {
            click = 1;
            if ($('.regist-image').val().length != 0)
                $('.edit-image').submit();
            else
                $('.alert-image').text('ファイルを選択してください');
            click = 0;
        }
    });

    $('.btn-edit-2').on('click', function() {
        if (update[0] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_birthday',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_year: $('.edit-year').val(),
                        new_month: $('.edit-month').val(),
                        new_day: $('.edit-day').val(),
                    }
                }).done(function (res) {
                    $('.item-num').val(2);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            if ($('.edit-year').val() == "未選択")
                $('.edit-year').css('color', 'red');

            if ($('.edit-month').val() == "未選択")
                $('.edit-month').css('color', 'red');

            if ($('.edit-day').val() == "未選択")
                $('.edit-day').css('color', 'red');
        }
    });

    $('.btn-edit-3').on('click', function() {
        if (update[1] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_address',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_address_1: $('.edit-address-1').val(),
                        new_address_2: $('.edit-address-2').val()
                    }
                }).done(function (res) {
                    $('.item-num').val(3);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            if ($('.edit-address-1').val() == "未選択")
                $('.edit-address-1').css('color', 'red');

            if ($('.edit-address-2').val().length == 0)
                $('.alert-address').text("未入力");
            else if ($('.edit-address-2').val().length > 15)
                $('.alert-address').text("制限字数を超えております");
        }
    });

    $('.btn-edit-4').on('click', function() {
        if (update[2] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_name',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_name: $('.edit-name').val()
                    }
                }).done(function (res) {
                    $('.item-num').val(4);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            if ($('.edit-name').val().length == 0)
                $('.alert-name').text('未入力');
            else if ($('.edit-name').val().length > 15)
                $('.alert-name').text('制限字数を超えております');
        }
    });

    $('.btn-edit-5').on('click', function() {
        if (update[3] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_email',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_email: $('.edit-email').val()
                    }
                }).done(function (res) {
                    $('.registed').val(res.registed);
                    $('.item-num').val(5);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            if ($('.edit-email').val().length == 0)
                $('.alert-email').text('未入力');
            else if ($('.edit-email').val().length > 50)
                $('.alert-email').text('制限字数を超えております');
            else if (!$('.edit-email').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/))
                $('.alert-email').text('無効の文字が含まれております');
            else if (!($('.edit-email').val().match(/^[A-Za-z0-9.]+[\w-]+@[\w\.-]+\.\w{2,}$/)))
                $('.alert-email').text('入力形式が正しくありません');
        }
    });

    $('.btn-edit-6').on('click', function() {
        if (update[4] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_tel',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_tel: $('.edit-tel').val()
                    }
                }).done(function (res) {
                    $('.registed').val(res.registed);
                    $('.item-num').val(6);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            if ($('.edit-tel').val().length == 0)
                $('.alert-tel').text('未入力');
            else if ($('.edit-tel').val().length != 11)
                $('.alert-tel').text('11桁入力してください');
            else if (!($('.edit-tel').val().match(/^[0-9]+$/)))
                $('.alert-tel').text('無効の文字が含まれております');
            else if (!($('.edit-tel').val().match(/^[0]+[57-9]+[0]+[0-9]{8}$/)))
                $('.alert-tel').text('入力形式が正しくありません');
        }
    });

    $('.btn-edit-7').on('click', function() {
        if (update[5] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_publish',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_publish_email: $('.publish-email').val(),
                        new_publish_tel: $('.publish-tel').val()
                    }
                }).done(function (res) {
                    $('.item-num').val(7);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            // メール
            if ($('.publish-email').val() == "未選択")
                $('.publish-email').css('color', 'red');

            // 電話
            if ($('.publish-tel').val() == "未選択")
                $('.publish-tel').css('color', 'red');
        }
    });

    $('.btn-edit-8').on('click', function() {
        if (update[6] == 1) {
            update[0] = 0;
            if (click == 0) {
                click = 1;
                if (device_no == 1)
                    class_name = ".answer-PC";
                else
                    class_name = ".answer-Phone";

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'ajax/update_double_lock',
                    dataType: 'json',
                    data: {
                        id: $('.id').val(),
                        new_setting_double_lock: $('.setting-double-lock').val(),
                        new_question: $('.question').val(),
                        new_answer: $(class_name).val()
                    }
                }).done(function (res) {
                    $('.item-num').val(8);
                    $('.update').submit();
                    click = 0;
                }).fail(function() {
                    alert('fail');
                });
            }
        } else {
            if ($('.setting-double-lock').val() == "未選択")
                $('.setting-double-lock').css('color', 'red');

            if ($('.setting-double-lock').val() == "質問") {
                if ($('.question').val().length == 0)
                    $('.alert-question').text('未入力');
                else if ($('.question').val().length > 30)
                    $('.alert-question').text('制限字数を超えております');

                if (device_no != 2) {
                    if ($('.answer-PC').val().length == 0)
                        $('.alert-answer').text('未入力');
                    else if ($('.answer-PC').val().length > 30)
                        $('.alert-answer').text('制限字数を超えております');
                } else {
                    if ($('.answer-Phone').val().length == 0)
                        $('.alert-answer').text('未入力');
                    else if ($('.answer-Phone').val().length > 30)
                        $('.alert-answer').text('制限字数を超えております');
                }
            }
        }
    });

    setInterval(function() {
        if (input[0] == 1) {
            // 生年月日
            if ($('.edit-year').val() == "未選択") {
                $('.edit-year').css('color', 'red');
                check_birth[0] = 0;
            } else {
                $('.edit-year').css('color', 'black');
                check_birth[0] = 1;
            }

            if ($('.edit-month').val() == "未選択") {
                $('.edit-month').css('color', 'red');
                check_birth[1] = 0;
            } else {
                $('.edit-month').css('color', 'black');
                check_birth[1] = 1;
            }

            if ($('.edit-day').val() == "未選択") {
                $('.edit-day').css('color', 'red');
                check_birth[2] = 0;
            } else {
                $('.edit-day').css('color', 'black');
                check_birth[2] = 1;
            }

            if (check_birth[0] == 1 && check_birth[1] == 1 && check_birth[2] == 1)
                update[0] = 1;
            else
                update[0] = 0;
        }

        // 住所
        if (input[1] == 1) {
            if ($('.edit-address-1').val() == "未選択") {
                $('.edit-address-1').css('color', 'red');
                check_address[0] = 0;
            } else {
                $('.edit-address-1').css('color', 'black');
                check_address[0] = 1;
            }

            if ($('.edit-address-2').val().length == 0) {
                $('.alert-address').text("未入力");
                check_address[1] = 0;
            } else if ($('.edit-address-2').val().length > 15) {
                $('.alert-address').text("制限字数を超えております");
                check_address[1] = 0;
            } else {
                $('.alert-address').text("");
                check_address[1] = 1;
            }

            if (check_address[0] == 1 && check_address[1] == 1)
                update[1] = 1;
            else
                update[1] = 0;
        }

        // 氏名
        if (input[2] == 1) {
            if ($('.edit-name').val().length == 0) {
                $('.alert-name').text('未入力');
                update[2] = 0;
            } else if ($('.edit-name').val().length > 15) {
                $('.alert-name').text('制限字数を超えております');
                update[2] = 0;
            } else {
                $('.alert-name').text('');
                update[2] = 1;
            }
        }

        // メール
        if (input[3] == 1) {
            if ($('.edit-email').val().length == 0) {
                $('.alert-email').text('未入力');
                update[3] = 0;
            } else if ($('.edit-email').val().length > 50) {
                $('.alert-email').text('制限字数を超えております');
                update[3] = 0;
            } else if (!$('.edit-email').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/)) {
                $('.alert-email').text('無効の文字が含まれております');
                update[3] = 0;
            } else if (!($('.edit-email').val().match(/^[A-Za-z0-9.]+[\w-]+@[\w\.-]+\.\w{2,}$/))) {
                $('.alert-email').text('入力形式が正しくありません');
                update[3] = 0;
            } else {
                $('.alert-email').text('');
                update[3] = 1;
            }
        }

        // 電話
        if (input[4] == 1) {
            if ($('.edit-tel').val().length == 0) {
                $('.alert-tel').text('未入力');
                update[4] = 0;
            } else if ($('.edit-tel').val().length != 11) {
                $('.alert-tel').text('11桁入力してください');
                update[4] = 0;
            } else if (!($('.edit-tel').val().match(/^[0-9]+$/))) {
                $('.alert-tel').text('無効の文字が含まれております');
                update[4] = 0;
            } else if (!($('.edit-tel').val().match(/^[0]+[57-9]+[0]+[0-9]{8}$/))) {
                $('.alert-tel').text('入力形式が正しくありません');
                update[4] = 0;
            } else {
                $('.alert-tel').text('');
                update[4] = 1;
            }
        }

        // 公開設定
        if (input[5] == 1) {
            // メール
            if ($('.publish-email').val() == "未選択") {
                $('.publish-email').css('color', 'red');
                check_publish[0] = 0;
            } else {
                $('.publish-email').css('color', 'black');
                check_publish[0] = 1;
            }
            // 電話
            if ($('.publish-tel').val() == "未選択") {
                $('.publish-tel').css('color', 'red');
                check_publish[1] = 0;
            } else {
                $('.publish-tel').css('color', 'black');
                check_publish[1] = 1;
            }

            if (check_publish[0] == 1 && check_publish[1] == 1)
                update[5] = 1;
            else
                update[5] = 0;
        }

        // 2要素認証
        if (input[6] == 1) {
            if (window.matchMedia('(max-width: 769px)').matches)
                device_no = 2;
            else
                device_no = 1;

            if ($('.setting-double-lock').val() == "未選択") {
                $('.setting-double-lock').css('color', 'red');
                check_double_lock[0] = 0;
            } else {
                $('.setting-double-lock').css('color', 'black');
                check_double_lock[0] = 1;
            }

            if ($('.setting-double-lock').val() == "質問") {
                $('.question').prop('disabled', false);
                $('.answer-PC').prop('disabled', false);
                $('.answer-Phone').prop('disabled', false);
                if ($('.question').val().length == 0) {
                    $('.alert-question').text('未入力');
                    check_double_lock[1] = 0;
                } else if ($('.question').val().length > 30) {
                    $('.alert-question').text('制限字数を超えております');
                    check_double_lock[1] = 0;
                } else {
                    $('.alert-question').text('');
                    check_double_lock[1] = 1;
                }

                if (device_no != 2) {
                    if ($('.answer-PC').val().length == 0) {
                        $('.alert-answer').text('未入力');
                        check_double_lock[2] = 0;
                    } else if ($('.answer-PC').val().length > 30) {
                        $('.alert-answer').text('制限字数を超えております');
                        check_double_lock[2] = 0;
                    } else {
                        $('.alert-answer').text('');
                        check_double_lock[2] = 1;
                    }
                } else {
                    if ($('.answer-Phone').val().length == 0) {
                        $('.alert-answer').text('未入力');
                        check_double_lock[2] = 0;
                    } else if ($('.answer-Phone').val().length > 30) {
                        $('.alert-answer').text('制限字数を超えております');
                        check_double_lock[2] = 0;
                    } else {
                        $('.alert-answer').text('');
                        check_double_lock[2] = 1;
                    }
                }

                if (check_double_lock[0] == 1 && check_double_lock[1] == 1 && check_double_lock[2] == 1)
                    update[6] = 1;
                else
                    update[6] = 0;
            } else {
                $('.alert-double-lock').text('');
                $('.answer').val('');
                $('.question').prop('disabled', true);
                $('.answer-PC').prop('disabled', true);
                $('.answer-Phone').prop('disabled', true);
                if (check_double_lock[0] == 1)
                    update[6] = 1;
                else
                    update[6] = 0;
            }
        }
    }, 2);
}

if ($('.view-mode').val() == 4) {
    $('input').on('focusin', function() {
        input_flg = 1;
        $('.alert-success').text('');
    }).on('focusout', function() {
        input_flg = 0;
        $('.alert-success').text('');
        if ($('.password').val().length == 0 && $('.password-retype').val().length == 0)
            $('.edit-password-form-wrapper .alert').text('');
    });

    $('.btn-edit-password').on('click', function() {
        if (update_password == 1) {
            update_password = 0;
            if (click == 0) {
                click  = 1;
                $('.cpy-password').val($('.password').val());
                $('.edit-password-form').submit();
            }
        } else {
            // パスワード
            if ($('.password').val().length == 0)
                $('.alert-password').text('未入力');
            else if (!($('.password').val().length >= 8 && $('.password').val().length <= 50))
                $('.alert-password').text('制限字数外');
            else if (!$('.password').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/))
                $('.alert-password').text('無効の文字が含まれております');
            else if ($('.password').val() != $('.password-retype').val())
                $('.alert-password').text('確認用と不一致');
            else
                $('.alert-password').text('');
            // 確認用
            if ($('.password-retype').val().length == 0)
                $('.alert-password-retype').text('未入力');
            else if (!($('.password-retype').val().length >= 8 && $('.password-retype').val().length <= 50))
                $('.alert-password-retype').text('制限字数外');
            else if (!$('.password-retype').val().match(/^[a-zA-Z0-9\d!?_+*'"`#$%&\-^\\@;:,./=~|[\](){}<>]+$/))
                $('.alert-password-retype').text('無効の文字が含まれております');
            else
                $('.alert-password-retype').text('');
        }
    });

    setInterval(function() {
        if (input_flg == 1) {
            // パスワード
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
            // 確認用
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
                update_password = 1;
            else
                update_password = 0;
        }
    }, 2);
}

