<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/login/style_PC.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style_Tablet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style_Phone.css') }}">
    <title>パスワード再設定</title>
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
                <input type="hidden" class="view-mode" value=1>
                <h2>パスワード再設定</h2>
                <p class="alert alert-password"></p>
                <input type="password" class="password" placeholder="パスワード：半角英数8〜50字">
                <p class="alert alert-password-retype"></p>
                <input type="password" class="password-retype" placeholder="パスワード確認用">
                <div class="button-wrapper">
                    <button class="btn-setting">設定</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/reset_password/event.js') }}"></script>
    <script src="{{ asset('js/reset_password/validate.js') }}"></script>
</body>
</html>

