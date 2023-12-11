<div class="menu">
    <div class="margin">
        <input type="hidden" class="id" value={{ $login_user_data[0]['id'] }}>
        <div class="user-name-wrapper-menu">
            <p>{{ $login_user_data[0]['name'] }}</p>
        </div>
        <div class="button-wrapper button-1">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="login" value=1>
                <input type="hidden" name="page" value=1>
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <button>投稿一覧</button>
            </form>
        </div>
        <div class="button-wrapper button-2">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="login" value=2>
                <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <input type="hidden" name="page" value=1>
                <button>掲示板投稿</button>
            </form>
        </div>
        <div class="button-wrapper button-3">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="login" value=3>
                <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <input type="hidden" name="view_mode" value=1>
                <input type="hidden" name="page" value=1>
                <button>
                    チャット
                    <div class="notice-mark"></div>
                </button>
            </form>
        </div>
        <div class="button-wrapper button-4">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="login" value=4>
                <input type="hidden" name="view_mode" value=1>
                <input type="hidden" name="page" value=1>
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <button>ユーザー検索</button>
            </form>
        </div>
        <div class="button-wrapper button-5">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="login" value=5>
                <input type="hidden" name="id" value="{{ $login_user_data[0]['id']; }}">
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <input type="hidden" name="view_mode" value=1>
                <input type="hidden" name="page" value=1>
                <button>お気に入りリスト</button>
            </form>
        </div>
        <div class="button-wrapper button-6">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="login" value=6>
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <input type="hidden" name="view_mode" value=1>
                <input type="hidden" name="page" value=1>
                <button>設定</button>
            </form>
        </div>
        <div class="button-wrapper button-7">
            <form style="width: 100%; height: 100%;" action="{{ route('account.root') }}" method="POST">
                @csrf
                <input type="hidden" name="logout" value=1>
                <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                <button>ログアウト</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/account/menu.js') }}"></script>
