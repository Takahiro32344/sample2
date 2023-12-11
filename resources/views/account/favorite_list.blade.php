@include('layouts.header')
<body>
    <div class="background">
        <img src="{{ asset('images/bg_login.jpg') }}">
        <div class="main-background"></div>
    </div>
    <div class="main-wrapper">
        <div class="main">
            @switch ($_POST['view_mode'])
                @case(1)
                    <h1>お気に入りリスト</h1>
                    <div class="favorite-list-wrapper">
                        <form style="display: none;" class="reload" action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=5>
                            <input type="hidden" name="view_mode" value=1>
                            <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <input type="hidden" name="page" value={{ $_POST['page'] }}>
                        </form>
                        <?php $id_counter = 0; ?>
                        <input type="hidden" class="id" value={{ $login_user_data[0]['id'] }}>
                        <input type="hidden" class="list-size" value={{ sizeof($favorite_list_data); }}>
                        @if (sizeof($favorite_list_data) != 0)
                            @for ($i = ($_POST['page'] * 100) - 100; $i < $_POST['page'] * 100; $i++)
                                @if ($i < sizeof($favorite_list_data))
                                    @for ($j = 0; $j < sizeof($AccountData); $j++)
                                        @if ($favorite_list_data[$i]['list_id'] == $AccountData[$j]['id'])
                                            <div class="favorite-list-data-wrapper list-{{ ++$id_counter; }}">
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
                                                </div>
                                                <div class="button-wrapper-1">
                                                    <form action="{{ route('account.root') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="login" value=5>
                                                        <input type="hidden" name="view_mode" value=2>
                                                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                                        <input type="hidden" name="detail_user_id" value="{{ $AccountData[$j]['id'] }}">
                                                        <input type="hidden" name="detail_birthday" value="{{ $AccountData[$j]['birthday'] }}">
                                                        <input type="hidden" name="detail_name" value="{{ $AccountData[$j]['name'] }}">
                                                        <input type="hidden" name="detail_gender" value="{{ $AccountData[$j]['gender'] }}">
                                                        <input type="hidden" name="detail_address_1" value="{{ $AccountData[$j]['address_1'] }}">
                                                        <input type="hidden" name="detail_address_2" value="{{ $AccountData[$j]['address_2'] }}">
                                                        <input type="hidden" name="detail_email" value="{{ $AccountData[$j]['email'] }}">
                                                        <input type="hidden" name="detail_tel" value="{{ $AccountData[$j]['tel'] }}">
                                                        <input type="hidden" name="detail_publish_email" value="{{ $AccountData[$j]['publish_email'] }}">
                                                        <input type="hidden" name="detail_publish_tel" value="{{ $AccountData[$j]['publish_tel'] }}">
                                                        <input type="hidden" name="detail_image" value="{{ $AccountData[$j]['update_image_name'] }}">
                                                        <button>詳細</button>
                                                    </form>
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
                            @endfor
                        @else
                            <h2>現在登録されておりません</h2>
                        @endif
                    </div>
                    @if (sizeof($favorite_list_data) != 0)
                        <div class="button-wrapper">
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=5>
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
                                <input type="hidden" name="login" value=5>
                                <input type="hidden" name="view_mode" value=1>
                                <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <?php
                                    $next = $_POST['page'];
                                    if (((double)(sizeof($favorite_list_data) / $_POST['page'] - 100)) > 0)
                                        $next++;
                                ?>
                                <input type="hidden" name="page" value=<?php echo $next; ?>>
                                <button>＞</button>
                            </form>
                        </div>
                    @endif
                    @break
                @case(2)
                    <input class="id" type="hidden" value={{ $login_user_data[0]['id'] }}>
                    <h1>詳細情報</h1>
                    <div class="search-user-detail-wrapper">
                        <div>
                            @if ($login_user_data[0]['id'] != $_POST['detail_user_id'])
                                <div class="button-wrapper-1">
                                    <form action="{{ route('account.root') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="login" value=5>
                                        <input type="hidden" name="view_mode" value=3>
                                        <input type="hidden" name="page" value=1>
                                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                        <input type="hidden" name="detail_user_id" value="{{ $_POST['detail_user_id'] }}">
                                        <input type="hidden" name="detail_name" value="{{ $_POST['detail_name'] }}">
                                        <input type="hidden" name="detail_birthday" value="{{ $_POST['detail_birthday'] }}">
                                        <input type="hidden" name="detail_gender" value="{{ $_POST['detail_gender'] }}">
                                        <input type="hidden" name="detail_address_1" value="{{ $_POST['detail_address_1'] }}">
                                        <input type="hidden" name="detail_address_2" value="{{ $_POST['detail_address_2'] }}">
                                        <input type="hidden" name="detail_email" value="{{ $_POST['detail_email'] }}">
                                        <input type="hidden" name="detail_tel" value="{{ $_POST['detail_tel'] }}">
                                        <input type="hidden" name="detail_publish_email" value="{{ $_POST['detail_publish_email'] }}">
                                        <input type="hidden" name="detail_publish_tel" value="{{ $_POST['detail_publish_tel'] }}">
                                        <input type="hidden" name="detail_image" value="{{ $_POST['detail_image'] }}">
                                        <button>投稿一覧</button>
                                    </form>
                                    <form action="{{ route('account.root') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="login" value=3>
                                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                        <input type="hidden" name="id" value="{{ $login_user_data[0]['id'] }}">
                                        <input type="hidden" name="opponent_id" value="{{ $_POST['detail_user_id'] }}">
                                        <input type="hidden" name="opponent_name" value="{{ $_POST['detail_name'] }}">
                                        <input type="hidden" name="opponent_image_name" value="{{ $_POST['detail_image'] }}">
                                        <input type="hidden" name="view_mode" value=2>
                                        <button>チャット</button>
                                    </form>
                                    <div class=""></div>
                                    <form action="{{ route('account.root') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="login" value=5>
                                        <input type="hidden" name="view_mode" value=1>
                                        <input type="hidden" name="page" value=1>
                                        <input type="hidden" name="delete" value=1>
                                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                        <input type="hidden" name="id" value="{{ $login_user_data[0]['id'] }}">
                                        <input type="hidden" name="list_id" value="{{ $_POST['detail_user_id'] }}">
                                        <button class="btn-delete">お気に入りから削除</button>
                                    </form>
                                </div>
                            @endif
                            <div class="text-align">
                                <div>
                                    <div class="image-wrapper">
                                        @if ($_POST['detail_image'] == NULL)
                                            <img src="{{ asset('images/user_icon.png') }}">
                                        @else
                                            <img src="{{ asset($_POST['detail_image']) }}">
                                        @endif
                                    </div>
                                    <p>生年月日：{{ $_POST['detail_birthday'] }}</p>
                                    <p>氏名：{{ $_POST['detail_name'] }}</p>
                                    <p>性別：{{ $_POST['detail_gender'] }}</p>
                                    <p>住所：{{ $_POST['detail_address_1'] }} : {{ $_POST['detail_address_2'] }}</p>
                                    @if ($_POST['detail_publish_email'] == 0)
                                        <p>E-MAIL：{{ $_POST['detail_email'] }}</p>
                                    @endif
                                    @if ($_POST['detail_publish_tel'] == 0)
                                        <p>TEL：{{ $_POST['detail_tel'] }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="button-wrapper-2">
                                <form action="{{ route('account.root') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="login" value=5>
                                    <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="view_mode" value=1>
                                    <input type="hidden" name="page" value=1>
                                    <button>戻る</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @break
                @case(3)
                    <h1>{{ $_POST['detail_name'] }}さんの投稿一覧</h1>
                    <div class="detail-bullentin-board-wrapper">
                        <div class="personal-bullentin-board-wrapper">
                            <?php $counter_detail = 0; ?>
                            @for($i = ($_POST['page'] * 60) - 60; $i < $_POST['page'] * 60; $i++)
                                @if ($i < sizeof($Bullentin_Board_Data))
                                    @if ($_POST['detail_user_id'] == $Bullentin_Board_Data[$i]['user_id'])
                                        <?php $counter_detail++; ?>
                                        <div class="padding">
                                            <p class="date">{{ $Bullentin_Board_Data[$i]['updated_at'] }}</p>
                                            <p>{{ nl2br($Bullentin_Board_Data[$i]['text']); }}</p>
                                        </div>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        @if ($counter_detail != 0)
                            <div class="button-wrapper">
                                <form action="{{ route('account.root') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="login" value=5>
                                    <input type="hidden" name="view_mode" value=3>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="detail_user_id" value="{{ $_POST['detail_user_id'] }}">
                                    <input type="hidden" name="detail_name" value="{{ $_POST['detail_name'] }}">
                                    <input type="hidden" name="detail_birthday" value="{{ $_POST['detail_birthday'] }}">
                                    <input type="hidden" name="detail_gender" value="{{ $_POST['detail_gender'] }}">
                                    <input type="hidden" name="detail_address_1" value="{{ $_POST['detail_address_1'] }}">
                                    <input type="hidden" name="detail_address_2" value="{{ $_POST['detail_address_2'] }}">
                                    <input type="hidden" name="detail_email" value="{{ $_POST['detail_email'] }}">
                                    <input type="hidden" name="detail_tel" value="{{ $_POST['detail_tel'] }}">
                                    <input type="hidden" name="detail_publish_email" value="{{ $_POST['detail_publish_email'] }}">
                                    <input type="hidden" name="detail_publish_tel" value="{{ $_POST['detail_publish_tel'] }}">
                                    <input type="hidden" name="detail_image" value="{{ $_POST['detail_image'] }}">
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
                                    <input type="hidden" name="login" value=5>
                                    <input type="hidden" name="view_mode" value=3>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="detail_user_id" value="{{ $_POST['detail_user_id'] }}">
                                    <input type="hidden" name="detail_name" value="{{ $_POST['detail_name'] }}">
                                    <input type="hidden" name="detail_birthday" value="{{ $_POST['detail_birthday'] }}">
                                    <input type="hidden" name="detail_gender" value="{{ $_POST['detail_gender'] }}">
                                    <input type="hidden" name="detail_address_1" value="{{ $_POST['detail_address_1'] }}">
                                    <input type="hidden" name="detail_address_2" value="{{ $_POST['detail_address_2'] }}">
                                    <input type="hidden" name="detail_email" value="{{ $_POST['detail_email'] }}">
                                    <input type="hidden" name="detail_tel" value="{{ $_POST['detail_tel'] }}">
                                    <input type="hidden" name="detail_publish_email" value="{{ $_POST['detail_publish_email'] }}">
                                    <input type="hidden" name="detail_publish_tel" value="{{ $_POST['detail_publish_tel'] }}">
                                    <input type="hidden" name="detail_image" value="{{ $_POST['detail_image'] }}">
                                    <?php
                                        $next = $_POST['page'];
                                        if (((double)(sizeof($Bullentin_Board_Data) / $_POST['page'] - 60)) > 0)
                                            $next++;
                                    ?>
                                    <input type="hidden" name="page" value=<?php echo $next; ?>>
                                    <button>＞</button>
                                </form>
                            </div>
                        @else
                            <h2>投稿はありません</h2>
                        @endif
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=5>
                            <input type="hidden" name="view_mode" value=2>
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <input type="hidden" name="detail_user_id" value="{{ $_POST['detail_user_id'] }}">
                            <input type="hidden" name="detail_name" value="{{ $_POST['detail_name'] }}">
                            <input type="hidden" name="detail_birthday" value="{{ $_POST['detail_birthday'] }}">
                            <input type="hidden" name="detail_gender" value="{{ $_POST['detail_gender'] }}">
                            <input type="hidden" name="detail_address_1" value="{{ $_POST['detail_address_1'] }}">
                            <input type="hidden" name="detail_address_2" value="{{ $_POST['detail_address_2'] }}">
                            <input type="hidden" name="detail_email" value="{{ $_POST['detail_email'] }}">
                            <input type="hidden" name="detail_tel" value="{{ $_POST['detail_tel'] }}">
                            <input type="hidden" name="detail_publish_email" value="{{ $_POST['detail_publish_email'] }}">
                            <input type="hidden" name="detail_publish_tel" value="{{ $_POST['detail_publish_tel'] }}">
                            <input type="hidden" name="detail_image" value="{{ $_POST['detail_image'] }}">
                            <button class="btn-return">戻る</button>
                        </form>
                    </div>
                    @break
            @endswitch
        </div>
    </div>

    @include('layouts.content_header')
    @include('layouts.menu')
    <script src="{{ asset('js/account/favorite_list.js') }}"></script>
</body>
@include('layouts.footer')

