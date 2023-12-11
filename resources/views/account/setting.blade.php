@include('layouts.header')
<body>
    <div class="background">
        <img src="{{ asset('images/bg_login.jpg') }}">
        <div class="main-background"></div>
    </div>
    <div class="main-wrapper">
        <div class="main">
            <input type="hidden" class="view-mode" value={{ $_POST['view_mode'] }}>
            <input type="hidden" class="id" value={{ $login_user_data[0]['id'] }}>
            <input type="hidden" class="id-name" value={{ $login_user_data[0]['id-name'] }}>
            @switch ($_POST['view_mode'])
                @case(1)
                    <h1>設定</h1>
                    <div class="setting-content-wrapper">
                        <div class="setting-menu">
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=6>
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <input type="hidden" name="view_mode" value=2>
                                <button>登録情報確認</button>
                            </form>
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=6>
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <input type="hidden" name="view_mode" value=3>
                                <button>登録情報変更</button>
                            </form>
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=6>
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <input type="hidden" name="view_mode" value=4>
                                <button>パスワード変更</button>
                            </form>
                            <button class="btn-delete-account">アカウント削除</button>
                            <form style="display: none;" class="delete-account-submit" action="{{ route('account.root') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @break;
                @case(2)
                    <h1>登録情報</h1>
                    <div class="setting-content-wrapper">
                        <div class="setting-view-detail-wrapper">
                            <div class="padding">
                                <div class="image-wrapper">
                                    @if ($login_user_data[0]['update_image_name'] == NULL)
                                        <img src="{{ asset('images/user_icon.png') }}">
                                    @else
                                        <img src="{{ asset($login_user_data[0]['update_image_name']) }}">
                                    @endif
                                </div>
                                <div class="personal-data-wrapper">
                                    <p>生年月日：{{ $login_user_data[0]['birthday']; }}</p>
                                    <p>氏名：{{ $login_user_data[0]['name']; }}</p>
                                    <p>性別：{{ $login_user_data[0]['gender']; }}</p>
                                    <p>住所：{{ $login_user_data[0]['address_1']; }} : {{ $login_user_data[0]['address_2']; }}</p>
                                    @if ($login_user_data[0]['publish_email'] == 0)
                                        <p>E-MAIL公開：する</p>
                                    @else
                                        <p>E-MAIL公開：しない</p>
                                    @endif
                                    @if ($login_user_data[0]['publish_tel'] == 0)
                                        <p>電話番号公開：する</p>
                                    @else
                                        <p>電話番号公開：しない</p>
                                    @endif
                                    <p>E-MAIL：{{ $login_user_data[0]['email']; }}</p>
                                    <p>TEL：{{ $login_user_data[0]['tel']; }}</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=6>
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <input type="hidden" name="view_mode" value=1>
                            <button>戻る</button>
                        </form>
                    </div>
                    @break;
                @case(3)
                    <h1>登録情報変更</h1>
                    <div class="setting-content-wrapper">
                        <div class="edit-personal-data-wrapper">
                            <div class="padding">
                                <form style="display: none;" class="reload-form" action="{{ route('account.root') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="updated_mage" value=1>
                                    <input type="hidden" name="login" value=6>
                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                    <input type="hidden" name="view_mode" value=3>
                                </form>
                                @if (!empty($_POST['updated_mage']))
                                    <p class="alert-success">登録画像を変更しました</p>
                                @endif
                                @if (!empty($_POST['alert']))
                                    @switch ($_POST['alert'])
                                        @case(1)
                                            <input type="hidden" class="reload" value=1>
                                            @break
                                        @case(2)
                                            <p class="alert-success">生年月日を変更しました</p>
                                            @break
                                        @case(3)
                                            <p class="alert-success">住所を変更しました</p>
                                            @break
                                        @case(4)
                                            <p class="alert-success">氏名を変更しました</p>
                                            @break
                                        @case(5)
                                            @if ($_POST['registed'] == 0)
                                                <p class="alert-success">E-MAILを変更しました</p>
                                            @else
                                                <p class="alert-success">既に登録されています</p>
                                            @endif
                                            @break
                                        @case(6)
                                            @if ($_POST['registed'] == 0)
                                                <p class="alert-success">TELを変更しました</p>
                                            @else
                                                <p class="alert-success">既に登録されています</p>
                                            @endif
                                            @break
                                        @case(7)
                                            <p class="alert-success">公開設定を変更しました</p>
                                            @break
                                        @case(8)
                                            <p class="alert-success">2要素認証を変更しました</p>
                                            @break
                                    @endswitch
                                @endif
                                <table border="1">
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">登録写真</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-image"></p>
                                                <form enctype='multipart/form-data' class="edit-image" action="{{ route('account.root') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="login" value=7>
                                                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                                    <input type="hidden" name="view_mode" value=3>
                                                    <input class="regist-image" name='upload_image' type='file'>
                                                    <input type="hidden" name="alert" value=1>
                                                    <input type="hidden" name="reload" value=1>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-1">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">生年月日</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <div class="margin">
                                                    <select class="edit-year">
                                                        <option>未選択</option>
                                                        @for ($i = 1960; $i <= date("Y") - 15; $i++)
                                                            <option>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <label>年</label><br class="display-br">
                                                    <select class="edit-month">
                                                        <option>未選択</option>
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <option>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <label>月</label><br class="display-br">
                                                    <select class="edit-day">
                                                        <option>未選択</option>
                                                        @for ($i = 1; $i <= 31; $i++)
                                                            <option>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <label>日</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-2">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">住所</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-address"></p>
                                                <div class="margin">
                                                    <select class="edit-address-1">
                                                    <option>未選択</option>
                                                    <option>北海道</option>
                                                    <option>青森県</option>
                                                    <option>秋田県</option>
                                                    <option>山形県</option>
                                                    <option>岩手県</option>
                                                    <option>宮城県</option>
                                                    <option>福島県</option>
                                                    <option>群馬県</option>
                                                    <option>栃木県</option>
                                                    <option>茨城県</option>
                                                    <option>埼玉県</option>
                                                    <option>東京都</option>
                                                    <option>千葉県</option>
                                                    <option>神奈川県</option>
                                                    <option>山梨県</option>
                                                    <option>長野県</option>
                                                    <option>新潟県</option>
                                                    <option>静岡県</option>
                                                    <option>愛知県</option>
                                                    <option>岐阜県</option>
                                                    <option>富山県</option>
                                                    <option>石川県</option>
                                                    <option>福井県</option>
                                                    <option>滋賀県</option>
                                                    <option>大阪府</option>
                                                    <option>奈良県</option>
                                                    <option>和歌山県</option>
                                                    <option>三重県</option>
                                                    <option>京都府</option>
                                                    <option>兵庫県</option>
                                                    <option>岡山県</option>
                                                    <option>広島県</option>
                                                    <option>山口県</option>
                                                    <option>島根県</option>
                                                    <option>鳥取県</option>
                                                    <option>香川県</option>
                                                    <option>愛媛県</option>
                                                    <option>徳島県</option>
                                                    <option>高知県</option>
                                                    <option>大分県</option>
                                                    <option>佐賀県</option>
                                                    <option>福岡県</option>
                                                    <option>熊本県</option>
                                                    <option>宮崎県</option>
                                                    <option>長崎県</option>
                                                    <option>鹿児島県</option>
                                                    <option>沖縄県</option>
                                                    </select><br class="display-br">
                                                    <input class="edit-address-2" type="text" placeholder="市町村：15字以内">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-3">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">氏名</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-name"></p>
                                                <input class="edit-name" placeholder="15字以内">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-4">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">E-MAIL</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-email"></p>
                                                <input class="edit-email" placeholder="50字以内">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-5">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">TEL</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-tel"></p>
                                                <input class="edit-tel" placeholder="携帯番号：11桁">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-6">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="edit-item-name">公開設定</label>
                                        </td>
                                        <td>
                                            <div class="edit-publish-content-wrapper padding-top-bottom">
                                                <div class="flex">
                                                    <label>E-MAIL</label>
                                                    <select class="publish-email">
                                                        <option>未選択</option>
                                                        <option>公開する</option>
                                                        <option>公開しない</option>
                                                    </select>
                                                </div>
                                                <div class="flex">
                                                    <label>TEL</label>
                                                    <select class="publish-tel">
                                                        <option>未選択</option>
                                                        <option>公開する</option>
                                                        <option>公開しない</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-edit-7">変更</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <label class="edit-item-name">2要素認証</label>
                                        </td>
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-question"></p>
                                                <div class="margin">
                                                    <select class="setting-double-lock">
                                                        <option>未選択</option>
                                                        <option>設定しない</option>
                                                        <option>質問</option>
                                                        <option>ワンタイムコード</option>
                                                    </select><br class="display-br">
                                                    <input class="question" placeholder="質問：30字以内" disabled>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="display-Phone">
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-answer"></p>
                                                <input class="answer-Phone" placeholder="答え：30字以内" disabled>
                                            </div>
                                        </td>
                                        <td rowspan="2">
                                            <button class="btn-edit-8">変更</button>
                                        </td>
                                    </tr>
                                    <tr class="display-PC">
                                        <td>
                                            <div class="padding-top-bottom">
                                                <p class="alert alert-answer"></p>
                                                <div class="margin">
                                                    <input class="answer-PC" placeholder="答え：30字以内" disabled>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <form style="display: none;" class="update" action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=6>
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <input type="hidden" name="view_mode" value=3>
                                <input type="hidden" class="registed" name="registed" value=0>
                                <input type="hidden" class="item-num" name="alert">
                            </form>
                        </div>
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=6>
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <input type="hidden" name="view_mode" value=1>
                            <button>戻る</button>
                        </form>
                    </div>
                    @break;
                @case(4)
                    <h1>パスワード変更</h1>
                    <div class="setting-content-wrapper">
                        <div class="edit-password-form-wrapper">
                            @if (!empty($_POST['edit']) && $_POST['edit'] == 1)
                                <p class="alert alert-success">パスワードを変更しました</p>
                            @endif
                            <p class="alert alert-password"></p>
                            <input type="password" class="password" placeholder="新しいパスワード:半角英数記号8〜50字"><br>
                            <p class="alert alert-password-retype"></p>
                            <input type="password" class="password-retype" placeholder="新しいパスワード(確認用)">
                        </div>
                        <div class="button-wrapper-1">
                            <form action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="login" value=6>
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <input type="hidden" name="view_mode" value=1>
                                <button>戻る</button>
                            </form>
                            <button class="btn-edit-password">変更</button>
                            <form style="display: none;" class="edit-password-form" action="{{ route('account.root') }}" method="POST">
                                @csrf
                                <input type="hidden" name="edit" value=1>
                                <input type="hidden" name="login" value=6>
                                <input type="hidden" name="password" class="cpy-password">
                                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                                <input type="hidden" name="view_mode" value=4>
                            </form>
                        </div>
                    </div>
                    @break;
            @endswitch
        </div>
    </div>

    @include('layouts.content_header')
    @include('layouts.menu')

    <script src="{{ asset('js/account/setting.js') }}"></script>
</body>
@include('layouts.footer')

