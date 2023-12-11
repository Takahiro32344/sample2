<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/login/style_PC.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style_Tablet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style_Phone.css') }}">
    <title>ログイン</title>
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
                @if (empty($_POST['view_mode']))
                    <input type="hidden" class="view-mode" value=1>
                    <h2>ログイン</h2>
                    <p class="alert"></p>
                    <div class="input-wrapper">
                        <input class="id-name" type="text" placeholder="ID"><br>
                        <input class="password" type="password" placeholder="パスワード">
                    </div>
                    <div class="button-wrapper">
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=0>
                            <input type="hidden" name="create" value=1>
                            <button class="btn-create-account">アカウント新規作成</button>
                        </form>
                        <button class="btn-login">ログイン</button>
                    </div>
                    <form action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input type="hidden" name="view_mode" value=4>
                        <button class="btn-forget">IDまたはパスワードを忘れた</button>
                    </form>
                    <form style="display: none;" class="login-1" action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input name="login" value=1>
                        <input name="page" value=1>
                        <input class="post-id-name" name="id_name">
                        <input class="post-password" name="password">
                    </form>
                    <form style="display: none;" class="login-2" action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input name="view_mode" value=2>
                        <input class="post-id-name" name="id_name">
                        <input class="post-password" name="password">
                    </form>
                    <form style="display: none;" class="login-3" action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input name="view_mode" value=3>
                        <input class="post-id-name" name="id_name">
                        <input class="post-password" name="password">
                    </form>
                @elseif ($_POST['view_mode'] == 2)
                    <input type="hidden" class="view-mode" value={{ $_POST['view_mode'] }}>
                    <input type="hidden" class="id-name" value={{ $_POST['id_name'] }}>
                    <h2>質問認証</h2>
                    <p>{{ $login_user_data[0]['question'] }}</p>
                    <p class="alert"></p>
                    <input class="answer" placeholder="答え">
                    <div class="button-wrapper">
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <button class="btn-return">戻る</button>
                        </form>
                        <button class="btn-login">ログイン</button>
                    </div>
                    <form style="display: none;" class="login-question" action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input name="login" value=1>
                        <input name="page" value=1>
                        <input class="post-id-name" name="id_name">
                        <input class="post-password" name="password">
                    </form>
                @elseif ($_POST['view_mode'] == 3)
                    <input type="hidden" class="view-mode" value={{ $_POST['view_mode'] }}>
                    <input type="hidden" class="id-name" value={{ $_POST['id_name'] }}>
                    <input type="hidden" class="created-core" value="{{ $code }}">
                    <h2>コード認証</h2>
                    <p class="font-size">登録メールアドレス宛に送信されたメールに記載された8桁のコードを入力してください</p>
                    <p class="alert"></p>
                    <input class="code" placeholder="8桁のコード">
                    <div class="button-wrapper">
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <button class="btn-return">戻る</button>
                        </form>
                        <button class="btn-login">ログイン</button>
                    </div>
                    <form style="display: none;" class="login-code" action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input name="login" value=1>
                        <input name="page" value=1>
                        <input class="post-id-name" name="id_name">
                        <input class="post-password" name="password">
                    </form>
                @elseif ($_POST['view_mode'] == 4)
                    <input type="hidden" class="view-mode" value={{ $_POST['view_mode'] }}>
                    <h2>IDまたはパスワードを忘れた</h2>
                    <p class="font-size">登録したメールアドレス宛にIDおよぴパスワード再設定ページURLを記載したメールを送信します</p>
                    <p class="alert"></p>
                    <input class="regist-email" placeholder="登録したメールアドレス">
                    <div class="button-wrapper">
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <button class="btn-return">戻る</button>
                        </form>
                        <button class="btn-login send">送信</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/login/event.js') }}"></script>
    <script src="{{ asset('js/login/validate.js') }}"></script>
</body>
</html>

