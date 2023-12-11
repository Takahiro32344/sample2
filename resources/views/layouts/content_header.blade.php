<div class="header-wrapper">
    <div class="header-background">
        <h1>Community Space</h1>
        <div class="header-left">
            @if ($login_user_data[0]['update_image_name'] == NULL)
                <img src="{{ asset('images/user_icon.png') }}">
            @else
                <img src="{{ asset($login_user_data[0]['update_image_name']) }}">
            @endif
        </div>
        <div class="header-right">
            <div class="user-name-wrapper">
                <div>
                    <p>{{ $login_user_data[0]['name']; }}</p>
                    <form action="{{ route('account.root') }}" method="POST">
                        @csrf
                        <input type="hidden" name="logout" value=1>
                        <input type="hidden" name="id_name" value="{{ $login_user_data[0]['id-name']; }}">
                        <button class="btn-logout">ログアウト</button>
                    </form>
                </div>
            </div>
            <div class="header-right-menu">
                <div class="border-1"></div>
                <div class="border-2"></div>
                <div class="border-3"></div>
                <p class="menu-navi"></p>
            </div>
        </div>
    </div>
</div>
