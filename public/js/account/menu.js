/*  メニュー  */

if (window.matchMedia('(min-width: 1100px)').matches) {
    device_num = 0;
    right_open = "0px";
    right_close = "-300px";
    $('.menu-navi').text('MENU');
} else if (window.matchMedia('(min-width: 769px)').matches) {
    device_num = 1;
    right_open = "0vw";
    right_close = "-30vw";
    $('.menu-navi').text('OPEN');
} else {
    device_num = 2;
    right_open = "0vw";
    right_close = "-70vw";
    $('.menu-navi').text('OPEN');
}

menu_flg = 0;

// マウス

let mouse_out = 1;

$('.header-right-menu').on('mouseover', function() {
    mouse_out = 0;
    if (menu_flg == 0)
        $('.menu-navi').text('OPEN');
    else
        $('.menu-navi').text('CLOSE');
}).on('mouseout', function() {
    mouse_out = 1;
    if (device_num == 0)
        $('.menu-navi').text('MENU');
    else {
        if (menu_flg == 0)
            $('.menu-navi').text('OPEN');
        else
            $('.menu-navi').text('CLOSE');
    }
}).on('click', function() {
    if (menu_flg == 0) {
        menu_flg = 1;
        $('.menu-navi').text('CLOSE');
        $('.menu').css({'transition':'1s', 'right': right_open});
    } else {
        menu_flg = 0;
        $('.menu-navi').text('OPEN');
        $('.menu').css({'transition':'1s', 'right': right_close});
    }
});

$('.btn-logout').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(180,180,180,0.7)', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(0,0,0,0)', 'color':'white'});
});

$('.button-1').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-1 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-1 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-2').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-2 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-2 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-3').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-3 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-3 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-4').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-4 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-4 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-5').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-5 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-5 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-6').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-6 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-6 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-7').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-7 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-7 button').css({'transition':'.7s', 'color':'white'});
});

$('.button-8').on('mouseover', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0.7)'});
    $('.button-8 button').css({'transition':'.7s', 'color':'rgb(50,20,10)'});
}).on('mouseout', function() {
    $(this).css({'transition':'.7s', 'background-color':'rgba(255,255,255,0)'});
    $('.button-8 button').css({'transition':'.7s', 'color':'white'});
});

let counter_all = 0;

setInterval(function() {
    if (window.matchMedia('(min-width: 1100px)').matches) {
        device_num = 0;
        right_open = "0px";
        right_close = "-300px";
        if (mouse_out == 1)
            $('.menu-navi').text('MENU').css({'transition':'.7s', 'color':'white'});
    } else if (window.matchMedia('(min-width: 769px)').matches) {
        device_num = 1;
        right_open = "0vw";
        right_close = "-30vw";
        if (menu_flg == 0)
            $('.menu-navi').text('OPEN');
        else
            $('.menu-navi').text('CLOSE');
    } else {
        device_num = 2;
        right_open = "0vw";
        right_close = "-70vw";
        if (menu_flg == 0)
            $('.menu-navi').text('OPEN');
        else
            $('.menu-navi').text('CLOSE');
    }

    if (menu_flg == 1)
        $('.menu').css({'transition':'1s', 'right': right_open});
    else
        $('.menu').css({'transition':'1s', 'right': right_close});

    if (counter_all != 0)
        $('.notice-mark').css('display', 'block');
    else
        $('.notice-mark').css('display', 'none');
}, 2);

setInterval(function() {
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
        for (let i = 0; i < res.chat_size; i++) {
            if (res.chat_data[i]['open'] == 0)
                counter_all++;
        }
    }).fail(function (res) {
        alert(res.id + ':' + res.list_id);
    });
}, 50);

