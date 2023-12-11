@include('layouts.header')
<body>
    <div class="background">
        <img src="{{ asset('images/bg_login.jpg') }}">
        <div class="main-background"></div>
    </div>
    <div class="main-wrapper">
        <div class="main">
            <input type="hidden" class="view-mode" value={{ $_POST['view_mode'] }}>
            @switch ($_POST['view_mode'])
                @case(1)
                    <h1>チャット履歴</h1>
                    <div class="chat-room-update-notice">
                        <p class="alert"></p>
                    </div>
                    <div class="chat-room-wrapper">
                        <form style="display: none;" class="reload" action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=3>
                            <input type="hidden" name="view_mode" value=1>
                            <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <input type="hidden" name="page" value={{ $_POST['page'] }}>
                        </form>
                        <?php $id_counter = 0; ?>
                        <input type="hidden" class="id" value={{ $login_user_data[0]['id'] }}>
                        <input type="hidden" class="list-size" value={{ sizeof($chat_room_data); }}>
                        @if (sizeof($chat_room_data) != 0)
                            @for ($i = ($_POST['page'] * 100) - 100; $i < $_POST['page'] * 100; $i++)
                                @if ($i < sizeof($chat_room_data))
                                    @if ($chat_room_data[$i]['account_id'] == $login_user_data[0]['id'])
                                        @for ($j = 0; $j < sizeof($AccountData); $j++)
                                            @if ($chat_room_data[$i]['from_id'] == $AccountData[$j]['id'])
                                                <div class="chat-room-list-wrapper list-{{ ++$id_counter; }}">
                                                    <input type="hidden" class="list-id-{{ $id_counter }}" value={{ $AccountData[$j]['id'] }}>
                                                    <div class="content-left">
                                                        <div class="image-wrapper">
                                                            @if ($AccountData[$j]['update_image_name'] == NULL)
                                                                <img src="{{ asset('images/user_icon.png') }}">
                                                            @else
                                                                <img src="{{ asset($AccountData[$j]['update_image_name']) }}">
                                                            @endif
                                                        </div>
                                                        <p>{{ $AccountData[$j]['name'] }}</p>
                                                        <input type="hidden" class="list-id" value={{ $AccountData[$j]['id'] }}>
                                                        <p class="counter-{{ $id_counter }}"></p>
                                                    </div>
                                                    <div class="button-wrapper-1">
                                                        <form action="{{ route('account.root') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="login" value=3>
                                                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                                            <input type="hidden" name="page" value=1>
                                                            <input type="hidden" name="view_mode" value=2>
                                                            <input type="hidden" name="id" value="{{ $login_user_data[0]['id'] }}">
                                                            <input type="hidden" name="opponent_id" value="{{ $AccountData[$j]['id'] }}">
                                                            <input type="hidden" name="opponent_name" value="{{ $AccountData[$j]['name'] }}">
                                                            <input type="hidden" name="opponent_image_name" value="{{ $AccountData[$j]['update_image_name'] }}">
                                                            <button>チャット</button>
                                                        </form>
                                                        <button class="btn-delete-{{ $id_counter }}">削除</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    @endif
                                @endif
                            @endfor
                        @else
                            <h2>履歴はありません</h2>
                        @endif
                    </div>
                    @if (sizeof($chat_room_data) != 0)
                        <div class="button-wrapper">
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=3>
                                <input type="hidden" name="view_mode" value=1>
                                <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <?php
                                    $back = $_POST['page'];
                                    if ($back > 1)
                                        $back--;
                                ?>
                                <input type="hidden" name="page" value=<?php echo $back; ?>>
                                <button>＜</button>
                            </form>
                            <p>{{ $_POST['page']; }}</p>
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=3>
                                <input type="hidden" name="view_mode" value=1>
                                <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <?php
                                    $next = $_POST['page'];
                                    if (((double)(sizeof($chat_room_data) / $_POST['page'] - 100)) > 0)
                                        $next++;
                                ?>
                                <input type="hidden" name="page" value=<?php echo $next; ?>>
                                <button>＞</button>
                            </form>
                        </div>
                    @endif
                    @break
                @case(2)
                    <h1>{{ $_POST['opponent_name'] }}さんとチャット</h1>
                    <input type="hidden" class="id" value={{ $login_user_data[0]['id'] }}>
                    <input type="hidden" class="list-id" value={{ $_POST['opponent_id'] }}>
                    <div class="chat-wrapper">
                        <div class="padding">
                            @for ($i = 0; $i < sizeof($chat_data); $i++)
                                @if ($chat_data[$i]['room_no'] == $login_user_data[0]['id'] && ($chat_data[$i]['account_id'] == $login_user_data[0]['id'] || $chat_data[$i]['to_id'] == $login_user_data[0]['id']))
                                    @if ($chat_data[$i]['account_id'] == $login_user_data[0]['id'] && $chat_data[$i]['to_id'] == $_POST['opponent_id'])
                                        <div class="chat-text-content-wrapper-1">
                                            <div style="display: flex; align-items: end;">
                                                <div>
                                                    @if ($chat_data[$i]['open'] == 1)
                                                        <p id="read-{{ $chat_data[$i]['id'] }}">既読</p>
                                                    @else
                                                        <p id="read-{{ $chat_data[$i]['id'] }}">未読</p>
                                                    @endif
                                                    <p>{{ $chat_data[$i]['time'] }}</p>
                                                </div>
                                                <div class="chat-text-wrapper">
                                                    <p><?php echo nl2br($chat_data[$i]['message']); ?></p>
                                                </div>
                                            </div>
                                            <div class="image-wrapper">
                                                @if ($login_user_data[0]['update_image_name'] == NULL)
                                                    <input type="hidden" class="image-name" value="images/user_icon.png">
                                                    <img src="{{ asset('images/user_icon.png') }}">
                                                @else
                                                    <input type="hidden" class="image-name" value="{{ $login_user_data[0]['update_image_name'] }}">
                                                    <img src="{{ asset($login_user_data[0]['update_image_name']) }}">
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($chat_data[$i]['account_id'] == $_POST['opponent_id'] && $chat_data[$i]['to_id'] == $login_user_data[0]['id'])
                                        <div class="chat-text-content-wrapper-2">
                                            <div class="image-wrapper">
                                                @if ($_POST['opponent_image_name'] == NULL)
                                                    <img src="{{ asset('images/user_icon.png') }}">
                                                @else
                                                    <img src="{{ asset($_POST['opponent_image_name']) }}">
                                                @endif
                                            </div>
                                            <div style="display: flex; align-items: end;">
                                                <div class="chat-text-wrapper">
                                                    <p><?php echo nl2br($chat_data[$i]['message']); ?></p>
                                                </div>
                                                <div>
                                                    <p>{{ $chat_data[$i]['time'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endfor
                            <div class="append"></div>
                        </div>
                    </div>
                    <div class="chat-message-form-wrapper">
                        <div>
                            <p class="alert-chat"></p>
                            <div style="display: flex;">
                                <form action="{{ route('account.root') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="login" value=3>
                                    <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="view_mode" value=1>
                                    <input type="hidden" name="page" value=1>
                                    <button>戻る</button>
                                </form>
                                <textarea class="message" placeholder="1000字以内"></textarea>
                                <button class="btn-send">送信</button>
                                <button class="btn-clear">クリア</button>
                                <form style="display: none;" class="submit-clear" action="{{ route('account.root') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="login" value=3>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                    <input type="hidden" name="page" value=1>
                                    <input type="hidden" name="view_mode" value=2>
                                    <input type="hidden" name="id" value="{{ $login_user_data[0]['id'] }}">
                                    <input type="hidden" name="opponent_id" value="{{ $_POST['opponent_id'] }}">
                                    <input type="hidden" name="opponent_name" value="{{ $_POST['opponent_name'] }}">
                                    <input type="hidden" name="opponent_image_name" value="{{ $_POST['opponent_image_name'] }}">
                                </form>
                            </div>
                        </div>
                    </div>
                    @break
            @endswitch
        </div>
    </div>

    @include('layouts.content_header')
    @include('layouts.menu')
    <script src="{{ asset('js/account/chat.js') }}"></script>
</body>
@include('layouts.footer')

