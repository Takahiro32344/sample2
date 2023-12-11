<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/create/style_PC.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create/style_Tablet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create/style_Phone.css') }}">
    <title>アカウント新規作成</title>
</head>
<body>
    <div class="background">
        <img src="{{ asset('images/bg_login.jpg') }}">
    </div>
    <div class="title-background"></div>
    <div class="wrapper">
        <div class="margin-top">
            <h1>Community Space</h1>
            <div class="border-form">
                <div>
                    @csrf
                    <h2>アカウント作成</h2>
                    <p class="alert alert-created"></p>
                    <table border=1 class="table-size">
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>生年月日</label>
                                </div>
                            </td>
                            <td width="70%">
                                <select name="birth_year" class="birth-year">
                                    <option>未選択</option>
                                    @for ($i = 1960; $i <= date("Y") - 15; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                                <label>年</label><br class="display-br">
                                <select name="birth_month" class="birth-month">
                                    <option>未選択</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                                <label>月</label><br class="display-br">
                                <select name="birth_day" class="birth-day">
                                    <option>未選択</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                                <label>日</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>性別</label>
                                </div>
                            </td>
                            <td width="70%">
                                <select name="gender" class="gender">
                                    <option>未選択</option>
                                    <option>男性</option>
                                    <option>女性</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>住所</label>
                                </div>
                            </td>
                            <td width="70%">
                                <p class="alert alert-address-2"></p>
                                <div class="flex-center">
                                    <select name="address_1" class="address-1">
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
                                    </select>
                                    <input name="address_2" class="address-2" type="text" placeholder="市町村:15字以内">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>氏名</label>
                                </div>
                            </td>
                            <td width="70%">
                                <p class="alert alert-name"></p>
                                <input name="name" class="name" type="text" placeholder="15字以内">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>ID</label>
                                </div>
                            </td>
                            <td width="70%">
                                <p class="alert alert-id-name"></p>
                                <input name="id_name" class="id-name" type="text" placeholder="半角英数記号50字以内">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>E-MAIL</label>
                                </div>
                            </td>
                            <td width="70%">
                                <p class="alert alert-mail"></p>
                                <input name="mail" class="mail" type="text" placeholder="半角英数記号50字以内">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>パスワード</label>
                                </div>
                            </td>
                            <td width="70%">
                                <p class="alert alert-password"></p>
                                <input name="password" class="password" type="password" placeholder="半角英数記号8〜50字">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="margin">
                                    <label>パスワード確認用</label>
                                </div>
                            </td>
                            <td width="70%">
                                <p class="alert alert-password-retype"></p>
                                <input name="password_retype" class="password-retype" type="password" placeholder="半角英数記号8〜50字">
                            </td>
                        </tr>
                    </table>
                    <div class="button-wrapper">
                        <a href="{{ route('account.root') }}">
                            <button class="btn-create-account"><div class="margin-top-1">戻る</div><div class="u-line-1"></div></button>
                        </a>
                        <button class="btn-create"><div class="margin-top-2">作成</div><div class="u-line-2"></div></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/create/event.js') }}"></script>
    <script src="{{ asset('js/create/validate.js') }}"></script>
</body>
</html>