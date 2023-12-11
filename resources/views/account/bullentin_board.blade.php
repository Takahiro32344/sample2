@include('layouts.header')
<body>
    <div class="background">
        <img src="{{ asset('images/bg_login.jpg') }}">
        <div class="main-background"></div>
    </div>
    <div class="main-wrapper">
        <div class="main">
            <h1>掲示板投稿</h1>
            <div class="bullentin-board-post-wrapper">
                <p class="alert"></p>
                <input type="hidden" class="id" value={{ $login_user_data[0]['id'] }}>
                <input type="hidden" class="size" value={{ sizeof($Personal_Bullentin_Board_Data) }}>
                <textarea placeholder="1000字以内"></textarea><br>
                <button class="btn-delete-all">投稿を全て削除</button>
                <button class="btn-post">投稿</button>
                <div class="bullentin-board-registed-wrapper">
                    <form style="display: none;" class="reload" action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input type="hidden" name="login" value=2>
                        <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                        <input type="hidden" name="page" value={{ $_POST['page'] }}>
                    </form>
                    <div class="post-realtime"></div>
                    @if (sizeof($Personal_Bullentin_Board_Data) != 0)
                        @for ($i = ($_POST['page'] * 50) - 50, $id_counter = 1; $i < $_POST['page'] * 50; $i++, $id_counter++)
                            @if ($i < sizeof($Personal_Bullentin_Board_Data))
                                <div class="bullentin-board-content-wrapper post-num-{{ $Personal_Bullentin_Board_Data[$i]['id'] }}">
                                    <input type="hidden" class="post-id-{{ $id_counter }}" value={{ $Personal_Bullentin_Board_Data[$i]['id'] }}>
                                    <button class="btn-delete-{{ $id_counter }}">削除</button>
                                    <div class="bullentin-board-text-wrapper">
                                        <div class="padding">
                                            <p class="date">{{ $Personal_Bullentin_Board_Data[$i]['updated_at'] }}</p>
                                            <p class="max-width"><?php echo nl2br($Personal_Bullentin_Board_Data[$i]['text']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    @endif
                    <h2 class="none-registed"></h2>
                </div>
                @if (sizeof($Personal_Bullentin_Board_Data) != 0)
                    <div class="button-wrapper">
                        <form action="{{ route('account.root') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login" value=2>
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
                            <input type="hidden" name="login" value=2>
                            <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                            <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                            <?php
                                $next = $_POST['page'];
                                if (((double)(sizeof($Personal_Bullentin_Board_Data) / $_POST['page'] - 50)) > 0)
                                    $next++;
                            ?>
                            <input type="hidden" name="page" value=<?php echo $next; ?>>
                            <button>＞</button>
                        </form>
                    </div>
                    @endif
            </div>
        </div>
    </div>

    @include('layouts.content_header')
    @include('layouts.menu')
    <script src="{{ asset('js/account/bullentin_board.js') }}"></script>
</body>
@include('layouts.header')

