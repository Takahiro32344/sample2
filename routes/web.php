<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
    Route::get('/', 'App\Http\Controllers\AccountController@root')->name('root');
    Route::post('/', 'App\Http\Controllers\AccountController@root')->name('root');
});

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function() {
    // ログイン
    Route::post('/login_check_1', 'App\Http\Controllers\AjaxController@login_check_1')->name('login_check_1');
    Route::post('/login_check_2', 'App\Http\Controllers\AjaxController@login_check_2')->name('login_check_2');
    Route::post('/login_check_3', 'App\Http\Controllers\AjaxController@login_check_3')->name('login_check_3');
    Route::post('/send_email', 'App\Http\Controllers\AjaxController@send_email')->name('send_email');
    // アカウント作成
    Route::post('/create_check', 'App\Http\Controllers\AjaxController@create_check')->name('create_check');
    // パスワード再設定
    Route::post('/reset_password', 'App\Http\Controllers\AjaxController@reset_password')->name('reset_password');
    // チャットルーム削除
    Route::post('/delete_chat_room', 'App\Http\Controllers\AjaxController@delete_chat_room')->name('delete_chat_room');
    // 掲示板データサイズチェック
    Route::post('/check_bullentin_borad_size', 'App\Http\Controllers\AjaxController@check_bullentin_borad_size')->name('check_bullentin_borad_size');
    // チャットルームサイズチェック
    Route::post('/check_room_size', 'App\Http\Controllers\AjaxController@check_room_size')->name('check_room_size');
    // チャットデータサイズチェック
    Route::post('/check_chat_size', 'App\Http\Controllers\AjaxController@check_chat_size')->name('check_chat_size');
    // チャットリードチェック
    Route::post('/check_read_chat', 'App\Http\Controllers\AjaxController@check_read_chat')->name('check_read_chat');
    // チャット送信
    Route::post('/send_chat', 'App\Http\Controllers\AjaxController@send_chat')->name('send_chat');
    // チャットクリア
    Route::post('/clear_chat', 'App\Http\Controllers\AjaxController@clear_chat')->name('clear_chat');
    // 掲示板投稿
    Route::post('/post_personal_bullentin_borad', 'App\Http\Controllers\AjaxController@post_personal_bullentin_borad')->name('post_personal_bullentin_borad');
    // 投稿内容削除
    Route::post('/delete_personal_bullentin_borad', 'App\Http\Controllers\AjaxController@delete_personal_bullentin_borad')->name('delete_personal_bullentin_borad');
    // お気に入りリスト削除
    Route::post('/delete_favorite', 'App\Http\Controllers\AjaxController@delete_favorite')->name('delete_favorite');
    // パスワード変更
    Route::post('/update_password', 'App\Http\Controllers\AjaxController@update_password')->name('update_password');
    // アカウント削除
    Route::post('/delete_account', 'App\Http\Controllers\AjaxController@delete_account')->name('delete_account');
    // 生年月日更新
    Route::post('/update_birthday', 'App\Http\Controllers\AjaxController@update_birthday')->name('update_birthday');
    // 住所更新
    Route::post('/update_address', 'App\Http\Controllers\AjaxController@update_address')->name('update_address');
    // 氏名更新
    Route::post('/update_name', 'App\Http\Controllers\AjaxController@update_name')->name('update_name');
    // メールアドレス更新
    Route::post('/update_email', 'App\Http\Controllers\AjaxController@update_email')->name('update_email');
    // 電話番号更新
    Route::post('/update_tel', 'App\Http\Controllers\AjaxController@update_tel')->name('update_tel');
    // 公開設定更新
    Route::post('/update_publish', 'App\Http\Controllers\AjaxController@update_publish')->name('update_publish');
    // ２要素認証更新
    Route::post('/update_double_lock', 'App\Http\Controllers\AjaxController@update_double_lock')->name('update_double_lock');
});
