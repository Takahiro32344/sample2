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
                    <h1>ユーザー検索</h1>
                    <div class="search-user-wrapper">
                        <form class="search-form" action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=4>
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <input type="hidden" name="view_mode" value=1>
                            <input type="hidden" name="page" value=1>

                            <input name="search_name" type="text" placeholder="名前"><br class="display-br">
                            <input name="search_address" type="text" placeholder="住所:都道府県"><br class="display-br">
                            <select name="search_gender">
                                <option>未選択</option>
                                <option>男性</option>
                                <option>女性</option>
                            </select><br>
                            <button class="btn-search">検索</button>
                        </form>
                        <div class="user-list-wrapper">
                            @for ($i = 0; $i < sizeof($AccountData); $i++)
                                <?php
                                    $counter_add[$i] = 0;
                                ?>
                            @endfor
                            @for ($i = ($_POST['page'] * 60) - 60; $i < $_POST['page'] * 60; $i++)
                                @if ($i < sizeof($AccountData))
                                    <form class="user-list-status-wrapper" action="{{ route('account.root') }}" method="POST">
                                        @csrf
                                        @for ($j = 0; $j < sizeof($registed_favorite_data); $j++)
                                            <?php
                                                if ($AccountData[$i]['id'] == $registed_favorite_data[$j]['list_id'] && $login_user_data[0]['id'] == $registed_favorite_data[$j]['account_id'])
                                                    $counter_add[$i]++;
                                            ?>
                                        @endfor
                                        <input type="hidden" name="login" value=4>
                                        <input type="hidden" name="view_mode" value=2>
                                        <input type="hidden" name="registed" value={{ $counter_add[$i] }}>
                                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                        <input type="hidden" name="detail_user_id" value="{{ $AccountData[$i]['id'] }}">
                                        <input type="hidden" name="detail_birthday" value="{{ $AccountData[$i]['birthday'] }}">
                                        <input type="hidden" name="detail_name" value="{{ $AccountData[$i]['name'] }}">
                                        <input type="hidden" name="detail_gender" value="{{ $AccountData[$i]['gender'] }}">
                                        <input type="hidden" name="detail_address_1" value="{{ $AccountData[$i]['address_1'] }}">
                                        <input type="hidden" name="detail_address_2" value="{{ $AccountData[$i]['address_2'] }}">
                                        <input type="hidden" name="detail_email" value="{{ $AccountData[$i]['email'] }}">
                                        <input type="hidden" name="detail_tel" value="{{ $AccountData[$i]['tel'] }}">
                                        <input type="hidden" name="detail_publish_email" value="{{ $AccountData[$i]['publish_email'] }}">
                                        <input type="hidden" name="detail_publish_tel" value="{{ $AccountData[$i]['publish_tel'] }}">
                                        <input type="hidden" name="detail_image" value="{{ $AccountData[$i]['update_image_name'] }}">
                                        <button>
                                            <div class="image-wrapper">
                                                @if ($AccountData[$i]['update_image_name'] == NULL)
                                                    <img src="{{ asset('images/user_icon.png') }}">
                                                @else
                                                    <img src="{{ asset($AccountData[$i]['update_image_name']) }}">
                                                @endif
                                            </div>
                                            <p>{{ $AccountData[$i]['name'] }}</p>
                                            <p>{{ $AccountData[$i]['gender'] }}</p>
                                            <p>{{ $AccountData[$i]['address_1'] }}</p>
                                        </button>
                                    </form>
                                @endif
                            @endfor
                        </div>
                        @if (sizeof($AccountData) != 0)
                            <div class="button-wrapper">
                                <form action="{{ route('account.root') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="login" value=4>
                                    <input type="hidden" name="view_mode" value=1>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="search_gender" value="未選択">
                                    @if (!empty($_POST['search_name']) && !empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @elseif (empty($_POST['search_name']) && !empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @elseif (!empty($_POST['search_name']) && empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @elseif (!empty($_POST['search_name']) && !empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] == "未選択")
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                    @elseif (!empty($_POST['search_name']))
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                    @elseif (!empty($_POST['search_address']))
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                    @elseif (!empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @endif
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
                                    <input type="hidden" name="login" value=4>
                                    <input type="hidden" name="view_mode" value=1>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="search_gender" value="未選択">
                                    @if (!empty($_POST['search_name']) && !empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @elseif (empty($_POST['search_name']) && !empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @elseif (!empty($_POST['search_name']) && empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @elseif (!empty($_POST['search_name']) && !empty($_POST['search_address']) && !empty($_POST['search_gender']) && $_POST['search_gender'] == "未選択")
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                    @elseif (!empty($_POST['search_name']))
                                        <input type="hidden" name="search_name" value="{{ $_POST['search_name']; }}">
                                    @elseif (!empty($_POST['search_address']))
                                        <input type="hidden" name="search_address" value="{{ $_POST['search_address']; }}">
                                    @elseif (!empty($_POST['search_gender']) && $_POST['search_gender'] != "未選択")
                                        <input type="hidden" name="search_gender" value="{{ $_POST['search_gender']; }}">
                                    @endif
                                    <?php
                                        $next = $_POST['page'];
                                        if (((double)(sizeof($AccountData) / $_POST['page'] - 60)) > 0)
                                            $next++;
                                    ?>
                                    <input type="hidden" name="page" value=<?php echo $next; ?>>
                                    <button>＞</button>
                                </form>
                            </div>
                        @else
                            <h2>検索結果はありません</h2>
                        @endif
                    </div>
                    @break
                @case(2)
                    <h1>詳細情報</h1>
                    <div class="search-user-detail-wrapper">
                        <div>
                            @if ($login_user_data[0]['id'] != $_POST['detail_user_id'])
                                <div class="button-wrapper-1">
                                    <form action="{{ route('account.root') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="login" value=4>
                                        <input type="hidden" name="view_mode" value=3>
                                        <input type="hidden" name="page" value=1>
                                        <input type="hidden" name="registed" value={{ $_POST['registed'] }}>
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
                                        <input type="hidden" name="view_mode" value=2>
                                        <input type="hidden" name="id" value="{{ $login_user_data[0]['id'] }}">
                                        <input type="hidden" name="opponent_id" value="{{ $_POST['detail_user_id'] }}">
                                        <input type="hidden" name="opponent_name" value="{{ $_POST['detail_name'] }}">
                                        <input type="hidden" name="opponent_image_name" value="{{ $_POST['detail_image'] }}">
                                        <button>チャット</button>
                                    </form>
                                    @if ($_POST['registed'] == 0)
                                        <form action="{{ route('account.root') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="registed" value=1>
                                            <input type="hidden" name="create" value=1>
                                            <input type="hidden" name="login" value=4>
                                            <input type="hidden" name="view_mode" value=2>
                                            <input type="hidden" name="page" value=1>
                                            <input type="hidden" name="id" value={{ $login_user_data[0]['id'] }}>
                                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                            <input type="hidden" name="list_id" value={{ $_POST['detail_user_id'] }}>
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
                                            <button class="btn-add">お気に入りに追加</button>
                                        </form>
                                    @else
                                        <form action="{{ route('account.root') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="registed" value=0>
                                            <input type="hidden" name="delete" value=1>
                                            <input type="hidden" name="login" value=4>
                                            <input type="hidden" name="view_mode" value=2>
                                            <input type="hidden" name="page" value=1>
                                            <input type="hidden" name="id" value={{ $login_user_data[0]['id'] }}>
                                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                            <input type="hidden" name="list_id" value={{ $_POST['detail_user_id'] }}>
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
                                            <button class="btn-delete">お気に入りから削除</button>
                                        </form>
                                    @endif
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
                                    <input type="hidden" name="login" value=4>
                                    <input type="hidden" name="view_mode" value=1>
                                    <input type="hidden" name="page" value=1>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name'] }}">
                                    <input type="hidden" name="registed" value={{ $_POST['registed'] }}>
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
                                    <input type="hidden" name="login" value=4>
                                    <input type="hidden" name="view_mode" value=3>
                                    <input type="hidden" name="registed" value={{ $_POST['registed'] }}>
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
                                    <input type="hidden" name="login" value=4>
                                    <input type="hidden" name="view_mode" value=3>
                                    <input type="hidden" name="registed" value={{ $_POST['registed'] }}>
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
                            <input type="hidden" name="login" value=4>
                            <input type="hidden" name="view_mode" value=2>
                            <input type="hidden" name="registed" value={{ $_POST['registed'] }}>
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
</body>
@include('layouts.footer')

