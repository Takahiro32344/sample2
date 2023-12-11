@include('layouts.header')
<body>
    <div class="background">
        <img src="{{ asset('images/bg_login.jpg') }}">
        <div class="main-background"></div>
    </div>
    <div class="main-wrapper">
        <div class="main">
            <h1>投稿一覧</h1>
            <div class="all-bullentin-board-wrapper">
                @for($i = ($_POST['page'] * 100) - 100; $i < $_POST['page'] * 100; $i++)
                    @if ($i < sizeof($Bullentin_Board_Data))
                        <div class="text-wrapper">
                            <div class="padding">
                                <div class="all-bullentin-board-date-wrapper">
                                    @for($j = 0; $j < sizeof($AccountData); $j++)
                                        @if ($AccountData[$j]['id'] == $Bullentin_Board_Data[$i]['user_id'])
                                            <p class="font-size-date">{{ $AccountData[$j]['name']; }}さんの投稿</p>
                                        @endif
                                    @endfor
                                    <p class="font-size-date">{{ $Bullentin_Board_Data[$i]['updated_at']; }}</p>
                                </div>
                                <p class="text"><?php echo nl2br($Bullentin_Board_Data[$i]['text']); ?></p>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
            <div class="button-wrapper">
                <form action="{{ route('account.root') }}" method="POST">
                    @csrf
                    <input type="hidden" name="login" value=1>
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
                    <input type="hidden" name="login" value=1>
                    <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                    <?php
                        $next = $_POST['page'];
                        if (((double)(sizeof($Bullentin_Board_Data) / $_POST['page'] - 100)) > 0)
                            $next++;
                    ?>
                    <input type="hidden" name="page" value=<?php echo $next; ?>>
                    <button>＞</button>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.content_header')
    @include('layouts.menu')
</body>
@include('layouts.footer')