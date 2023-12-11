<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountModel;
use App\Models\Bullentin_BoardModel;
use App\Models\FavoriteListModel;
use App\Models\ChatRoomModel;
use App\Models\ChatModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    // ルート
    public function root(Request $req) {
        date_default_timezone_set('Asia/Tokyo');
        if ($req->login == NULL) {
            if (!empty($_GET)) {
                return view("account/reset_password");
            }

            if ($req->view_mode == 2) {
                return view("account/login", [
                    'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                    'error' => NULL,
                    'login' => $req->login
                ]);
            }

            if ($req->view_mode == 3) {
                $code = "";
                for ($i = 0; $i < 8; $i++)
                    $code .= rand(0,9);

                $Account_Data = AccountModel::where('id-name', $req->id_name)->get();

                DB::table('accounts')->where('id-name', $req->id_name)->update([
                    'one_time_code' => password_hash($code, PASSWORD_DEFAULT)
                ]);

                mb_language("Japanese");
                mb_internal_encoding("UTF-8");
                mb_send_mail($Account_Data[0]['email'], "認証コード", $code);

                return view("account/login", [
                    'code' => $code,
                    'login_user_data' => $Account_Data,
                    'error' => NULL,
                    'login' => $req->login
                ]);
            }

            if ($req->logout == 1) {
                DB::table('accounts')->where('id-name', $req->id_name)->update([
                    'login_status' => 0
                ]);
            }

            return view("account/login", ['error' => NULL, 'login' => $req->login]);
        } else {
            DB::table('accounts')->where('id-name', $req->id_name)->update([
                'login_status' => 1
            ]);

            switch ($req->login) {
                case 0:
                    return view("account/create");
                    break;
                case 1:
                    return view("account/index", [
                        'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                        'AccountData' => AccountModel::all(),
                        'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                    ]);
                    break;
                case 2:
                    return view("account/bullentin_board", [
                        'Personal_Bullentin_Board_Data' => Bullentin_BoardModel::where('user_id', $req->id)->orderBy('updated_at', 'desc')->get(),
                        'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                        'AccountData' => AccountModel::all()
                    ]);
                    break;
                case 3:
                    if ($req->view_mode == 2) {
                        DB::table('accounts')->where('id-name', $req->id_name)->update([
                            'login_status' => 2
                        ]);

                        DB::table('chat')->where('open', 0)->where('room_no', $req->id)->where('account_id', $req->opponent_id)->where('to_id', $req->id)->update([
                            'open' => 1
                        ]);
                        DB::table('chat')->where('open', 0)->where('room_no', $req->opponent_id)->where('account_id', $req->opponent_id)->where('to_id', $req->id)->update([
                            'open' => 1
                        ]);

                        if (sizeof(ChatRoomModel::where('room_no', $req->id)->where('account_id', $req->id)->where('from_id', $req->opponent_id)->get()) == 0) {
                            DB::table('chat_room')->insert([
                                'room_no' => $req->id,
                                'account_id' => $req->id,
                                'from_id' => $req->opponent_id,
                                'created_at' => date("Y/m/d G:i:s"),
                                'updated_at' => date("Y/m/d G:i:s")
                            ]);
                        }
                    }

                    return view("account/chat", [
                        'chat_data' => ChatModel::all(),
                        'chat_room_data' => ChatRoomModel::where('room_no', $req->id)->where('account_id', $req->id)->get(),
                        'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                        'AccountData' => AccountModel::all()
                    ]);
                    break;
                case 4:
                    if ($req->create == 1) {
                        DB::table('favorite_list')->insert([
                            'account_id' => $req->id,
                            'list_id' => $req->list_id,
                            'created_at' => date("Y/m/d G:i:s"),
                            'updated_at' => date("Y/m/d G:i:s")
                        ]);
                    }

                    if ($req->delete == 1)
                        DB::table('favorite_list')->where('account_id', $req->id)->where('list_id', $req->list_id)->delete();

                    if ($req->search_name == NULL && $req->search_address == NULL && ($req->search_gender == NULL || $req->search_gender == "未選択")) {
                        return view("account/search_user", [
                            'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                            'registed_favorite_data' => FavoriteListModel::all(),
                            'AccountData' => AccountModel::all(),
                            'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                        ]);
                    } else {
                        if ($req->search_name != NULL && $req->search_address != NULL && $req->search_gender != "未選択") {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('name', 'like', "%$req->search_name%")->where('address_1', 'like', "%$req->search_address%")->where('gender', $req->search_gender)->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        } else if ($req->search_name == NULL && $req->search_address != NULL && $req->search_gender != "未選択") {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('address_1', 'like', "%$req->search_address%")->where('gender', $req->search_gender)->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        } else if ($req->search_name != NULL && $req->search_address == NULL && $req->search_gender != "未選択") {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('name', 'like', "%$req->search_name%")->where('gender', $req->search_gender)->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        } else if ($req->search_name != NULL && $req->search_address != NULL && $req->search_gender == "未選択") {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('name', 'like', "%$req->search_name%")->where('address_1', 'like', "%$req->search_address%")->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        } else if ($req->search_name != NULL) {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('name', 'like', "%$req->search_name%")->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        } else if ($req->search_address != NULL) {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('address_1', 'like', "%$req->search_address%")->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        } else if ($req->search_gender != "未選択") {
                            return view("account/search_user", [
                                'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                                'registed_favorite_data' => FavoriteListModel::all(),
                                'AccountData' => AccountModel::where('gender', $req->search_gender)->get(),
                                'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                            ]);
                        }
                    }
                    break;
                case 5:
                    if ($req->delete == 1)
                        DB::table('favorite_list')->where('account_id', $req->id)->where('list_id', $req->list_id)->delete();

                    return view("account/favorite_list", [
                        'favorite_list_data' => FavoriteListModel::where('account_id', $req->id)->get(),
                        'registed_favorite_data' => FavoriteListModel::all(),
                        'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                        'AccountData' => AccountModel::all(),
                        'Bullentin_Board_Data' => Bullentin_BoardModel::orderBy('updated_at', 'desc')->get()
                    ]);
                    break;
                case 6:
                    if ($req->password != NULL) {
                        DB::table('accounts')->where('id-name', $req->id_name)->update([
                            'password' => password_hash($req->password, PASSWORD_DEFAULT)
                        ]);
                    }

                    return view("account/setting", [
                        'login_user_data' => AccountModel::where('id-name', $req->id_name)->get(),
                    ]);
                    break;
                case 7:
                    $login_user_data = AccountModel::where('id-name', $req->id_name)->get();
                    $file_name = $req->file('upload_image')->getClientOriginalName();
                    $path = $req->file('upload_image')->storeAs('public/images/'. $login_user_data[0]['id-name'], $file_name);
                    $file = $req->file('upload_image')->move('images/' . $login_user_data[0]['id-name'], $file_name);

                    DB::table('accounts')->where('id-name', $req->id_name)->update([
                        'update_image_name' => $file
                    ]);

                    return view("account/setting", [
                        'login_user_data' => $login_user_data,
                    ]);
                    break;
            }
        }
    }

    // パスワード再設定
    public function reset_password(Request $req) {
        return view('account/reset_password');
    }
}

