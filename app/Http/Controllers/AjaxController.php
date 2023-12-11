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

class AjaxController extends Controller
{
    // ログインチェック
    public function login_check_1(Request $req) {
        $Account_Data = AccountModel::where('id-name', $req->id_name)->get();
        if (sizeof($Account_Data) == 0)
            return response()->json(['error' => 1]);
        else if (!(password_verify($req->password, $Account_Data[0]['password'])))
            return response()->json(['error' => 2]);
        else {
            switch ($Account_Data[0]['certification_flag']) {
                case 0:
                    $certification = 0;
                    break;
                case 1:
                    $certification = 1;
                    break;
                case 2:
                    $certification = 2;
                    break;
            }
            return response()->json(['error' => 0, 'certification' => $certification]);
        }
    }

    public function login_check_2(Request $req) {
        $Account_Data = AccountModel::where('id-name', $req->id_name)->get();
        if (!password_verify($req->answer, $Account_Data[0]['answer']))
            return response()->json(['error' => 1]);
        else
            return response()->json(['error' => 0]);
    }

    public function login_check_3(Request $req) {
        $Account_Data = AccountModel::where('id-name', $req->id_name)->get();
        if (password_verify($req->code, $Account_Data[0]['one_time_code'])) {
            DB::table('accounts')->where('id-name', $req->id_name)->update([
                'one_time_code' => NULL
            ]);

            return response()->json(['error' => 0]);
        } else
            return response()->json(['error' => 1]);
    }

    public function send_email(Request $req) {
        $Account_Data = AccountModel::where('email', $req->regist_email)->get();
        if (sizeof($Account_Data) == 0)
            return response()->json(['error' => 1]);
        else {
            mb_language("Japanese");
            mb_internal_encoding("UTF-8");
            mb_send_mail($req->regist_email, "ID及びパスワード再設定について", "ID:{$Account_Data[0]['id-name']}\r\r\rパスワード再設定URL:https://sample/account?id_name={$Account_Data[0]['id-name']}");

            return response()->json(['error' => 0, 'id' => $Account_Data[0]['id'], 'id_name' => $Account_Data[0]['id-name']]);
        }
    }

    // アカウント作成チェック
    public function create_check(Request $req) {
        date_default_timezone_set('Asia/Tokyo');
        $error = 0;
        $Account_Data_1 = AccountModel::where('id-name', $req->id_name)->get();
        $Account_Data_2 = AccountModel::where('email', $req->mail)->get();

        if (sizeof($Account_Data_1) != 0 && sizeof($Account_Data_2) != 0)
            $error = 1;
        else if (sizeof($Account_Data_1) != 0)
            $error = 2;
        else if (sizeof($Account_Data_2) != 0)
            $error = 3;
        else {
            DB::table('accounts')->insert([
                'birthday' => $req->birth_year . "年" . $req->birth_month . "月" . $req->birth_day . "日" ,
                'gender' => $req->gender,
                'address_1' => $req->address_1,
                'address_2' => $req->address_2,
                'name' => $req->name,
                'id-name' => $req->id_name,
                'email' => $req->mail,
                'tel' => '未設定',
                'password' => password_hash($req->password, PASSWORD_DEFAULT),
                'publish_email' => 1,
                'publish_tel' => 1,
                'created_at' => date("Y/m/d G:i:s"),
                'updated_at' => date("Y/m/d G:i:s")
            ]);
        }

        return response()->json(['error' => $error]);
    }

    // パスワード再設定
    public function reset_password(Request $req) {
        $Account_Data = AccountModel::where('id-name', $req->id_name)->get();
        if (sizeof($Account_Data) == 0)
            return response()->json(['error' => 1]);
        else {
            AccountModel::where('id-name', $req->id_name)->update([
                'password' => password_hash($req->password, PASSWORD_DEFAULT)
            ]);
            return response()->json(['error' => 0]);
        }
    }

    // 掲示板
    public function check_bullentin_borad_size(Request $req) {
        return response()->json(['size' => sizeof(Bullentin_BoardModel::where('user_id', $req->id)->orderBy('updated_at', 'desc')->get())]);
    }

    public function post_personal_bullentin_borad(Request $req) {
        date_default_timezone_set('Asia/Tokyo');
        DB::table('bullentin_board')->insert([
            'user_id' => $req->id,
            'text' => $req->text,
            'date' => date("Y/m/d G:i:s"),
            'created_at' => date("Y/m/d G:i:s"),
            'updated_at' => date("Y/m/d G:i:s")
        ]);

        $data = Bullentin_BoardModel::where('user_id', $req->id)->orderBy('updated_at', 'desc')->get();

        return response()->json(['id' => $data[0]['id'], 'text' => $data[0]['text'], 'date' => $data[0]['date']]);
    }

    public function delete_personal_bullentin_borad(Request $req) {
        switch ($req->flg) {
            case 1:
                DB::table('bullentin_board')->where('user_id', $req->id)->delete();
                break;
            case 2:
                DB::table('bullentin_board')->where('id', $req->post_id)->where('user_id', $req->id)->delete();
                break;
        }

        return response()->json(['size' => sizeof(Bullentin_BoardModel::where('user_id', $req->id)->orderBy('updated_at', 'desc')->get())]);
    }

    // チャット
    public function delete_chat_room(Request $req) {
        DB::table('chat_room')->where('room_no', $req->id)->where('account_id', $req->id)->where('from_id', $req->list_id)->delete();
        DB::table('chat')->where('room_no', $req->id)->where('account_id', $req->id)->where('to_id', $req->list_id)->delete();
        DB::table('chat')->where('room_no', $req->id)->where('account_id', $req->list_id)->where('to_id', $req->id)->delete();
        DB::table('chat')->where('open', 0)->where('room_no', $req->list_id)->where('account_id', $req->list_id)->where('to_id', $req->id)->update([
            'open' => 2
        ]);

        return response()->json(['list_size' => sizeof(ChatRoomModel::where('account_id', $req->id)->where('account_id', $req->id)->get()) , 'id' => $req->id, 'list_id' => $req->list_id]);
    }

    public function check_room_size(Request $req) {
        $chat_room = ChatRoomModel::where('room_no' , $req->id)->where('account_id', $req->id)->get();
        $chat_data = ChatModel::where('room_no' , $req->id)->where('to_id' , $req->id)->where('open', 0)->get();

        return response()->json(['room_size' => sizeof($chat_room), 'chat_size' => sizeof($chat_data), 'chat_data' => $chat_data]);
    }

    public function check_chat_size(Request $req) {
        if ($req->view_mode == 1) {
            $chat_room = ChatRoomModel::where('room_no' , $req->id)->where('account_id', $req->id)->get();
            $chat = ChatModel::where('room_no' , $req->id)->where('to_id' , $req->id)->where('open', 0)->get();

            return response()->json(['chat_room_size' => sizeof($chat_room), 'chat_room' => $chat_room, 'chat_data_size' => sizeof($chat), 'chat_data' => $chat]);
        } else {
            $chat_data = ChatModel::where('room_no', $req->id)->where('account_id', $req->list_id)->where('to_id', $req->id)->orderBy('updated_at', 'desc')->get();
            if ($req->now_chat_data_size == 0 && $req->now_chat_data_size == sizeof($chat_data))
                return response()->json(['flg' => 0, 'chat_data_size' => sizeof($chat_data)]);
            else {
                $image_name = "images/user_icon.png";
                $Account_Data = AccountModel::where('id', $req->list_id)->get();
                if ($Account_Data[0]['update_image_name'] != NULL)
                    $image_name = $Account_Data[0]['update_image_name'];
                return response()->json(['flg' => 1, 'chat_data_size' => sizeof($chat_data), 'time' => $chat_data[0]['time'], 'message' => $chat_data[0]['message'], 'image_name' => $image_name]);
            }
        }
    }

    public function check_read_chat(Request $req) {
        $Account_Data = AccountModel::where('id', $req->list_id)->get();
        if ($Account_Data[0]['login_status'] == 2) {
            DB::table('chat')->where('open', 0)->where('room_no', $req->list_id)->where('account_id', $req->list_id)->where('to_id', $req->id)->update([
                'open' => 1
            ]);
            DB::table('chat')->where('open', 0)->where('room_no', $req->id)->where('account_id', $req->list_id)->where('to_id', $req->id)->update([
                'open' => 1
            ]);
        }

        $chat_data = ChatModel::where('room_no', $req->id)->where('account_id', $req->id)->where('to_id', $req->list_id)->get();

        return response()->json(['chat_data' => $chat_data]);
    }

    public function send_chat(Request $req) {
        date_default_timezone_set('Asia/Tokyo');
        $room_data = ChatRoomModel::where('room_no', $req->list_id)->where('account_id', $req->list_id)->where('from_id', $req->id)->get();

        if (sizeof($room_data) == 0) {
            DB::table('chat_room')->insert([
                'room_no' => $req->list_id,
                'account_id' => $req->list_id,
                'from_id' => $req->id,
                'created_at' => date("Y/m/d G:i:s"),
                'updated_at' => date("Y/m/d G:i:s")
            ]);
        }

        DB::table('chat')->insert([
            'room_no' => $req->id,
            'account_id' => $req->id,
            'to_id' => $req->list_id,
            'message' => $req->message,
            'time' => date("G:i"),
            'open' => 0,
            'created_at' => date("Y/m/d G:i:s"),
            'updated_at' => date("Y/m/d G:i:s")
        ]);

        DB::table('chat')->insert([
            'room_no' => $req->list_id,
            'account_id' => $req->id,
            'to_id' => $req->list_id,
            'message' => $req->message,
            'time' => date("G:i"),
            'open' => 0,
            'created_at' => date("Y/m/d G:i:s"),
            'updated_at' => date("Y/m/d G:i:s")
        ]);

        $chat_data = ChatModel::where('room_no', $req->id)->where('account_id', $req->id)->where('to_id', $req->list_id)->orderBy('updated_at', 'desc')->get();
        $Account_Data = AccountModel::where('id', $req->id)->get();
        return response()->json(['chat_id' => $chat_data[0]['id'], 'open' => $chat_data[0]['open'], 'time' => $chat_data[0]['time'], 'message' => $chat_data[0]['message'], 'image_name' => $Account_Data[0]['update_image_name']]);
    }

    public function clear_chat(Request $req) {
        DB::table('chat')->where('room_no', $req->id)->where('account_id', $req->id)->where('to_id', $req->list_id)->delete();
        DB::table('chat')->where('room_no', $req->id)->where('account_id', $req->list_id)->where('to_id', $req->id)->delete();

        return response()->json([]);
    }

    // お気に入りリスト削除
    public function delete_favorite(Request $req) {
        DB::table('favorite_list')->where('account_id', $req->id)->where('list_id', $req->list_id)->delete();

        return response()->json(['list_size' => sizeof(FavoriteListModel::where('account_id', $req->id)->get()) , 'id' => $req->id, 'list_id' => $req->list_id]);
    }

    // パスワード変更
    public function update_password(Request $req) {
        DB::table('accounts')->where('id', $req->id)->update([
            'password' => password_hash($req->password, PASSWORD_DEFAULT)
        ]);
        return response()->json([]);
    }

    // アカウント削除
    public function delete_account(Request $req) {
        // 画像削除
        File::deleteDirectory(public_path() . "/images/{$req->id_name}");
        Storage::deleteDirectory("public/images/{$req->id_name}");
        // 掲示板削除
        DB::table('bullentin_board')->where('user_id', $req->id)->delete();
        // チャットルーム削除
        DB::table('chat_room')->where('room_no', $req->id)->delete();
        DB::table('chat_room')->where('from_id', $req->id)->delete();
        // チャットデータ削除
        DB::table('chat')->where('account_id', $req->id)->delete();
        DB::table('chat')->where('to_id', $req->id)->delete();
        // お気に入りリスト削除
        DB::table('favorite_list')->where('account_id', $req->id)->delete();
        // アカウント削除
        DB::table('accounts')->where('id', $req->id)->delete();

        return response()->json([]);
    }

    // 生年月日更新
    public function update_birthday(Request $req) {
        DB::table('accounts')->where('id', $req->id)->update([
            'birthday' => $req->new_year . '年' . $req->new_month . '月' .$req->new_day . '日'
        ]);

        return response()->json([]);
    }

    // 住所更新
    public function update_address(Request $req) {
        DB::table('accounts')->where('id', $req->id)->update([
            'address_1' => $req->new_address_1,
            'address_2' => $req->new_address_2
        ]);

        return response()->json([]);
    }

    // 氏名更新
    public function update_name(Request $req) {
        DB::table('accounts')->where('id', $req->id)->update([
            'name' => $req->new_name
        ]);

        return response()->json([]);
    }

    // メールアドレス更新
    public function update_email(Request $req) {
        $counter = 0;
        $Account_Data = AccountModel::all();
        for ($i = 0; $i < sizeof($Account_Data); $i++) {
            if ($Account_Data[$i]['email'] == $req->new_email)
                $counter++;
        }

        if ($counter == 0) {
            DB::table('accounts')->where('id', $req->id)->update([
                'email' => $req->new_email
            ]);
        }

        return response()->json(['registed' => $counter]);
    }

    // 電話番号更新
    public function update_tel(Request $req) {
        $counter = 0;
        $Account_Data = AccountModel::all();
        for ($i = 0; $i < sizeof($Account_Data); $i++) {
            if ($Account_Data[$i]['tel'] == $req->new_tel)
                $counter++;
        }

        if ($counter == 0) {
            DB::table('accounts')->where('id', $req->id)->update([
                'tel' => $req->new_tel
            ]);
        }

        return response()->json(['registed' => $counter]);
    }

    // 公開設定更新
    public function update_publish(Request $req) {
        if ($req->new_publish_email == "公開する")
            $publish_email = 0;
        else
            $publish_email = 1;

        if ($req->new_publish_tel == "公開する")
            $publish_tel = 0;
        else
            $publish_tel = 1;

        DB::table('accounts')->where('id', $req->id)->update([
            'publish_email' => $publish_email,
            'publish_tel' => $publish_tel,
        ]);

        return response()->json([]);
    }

    // 2要素認証更新
    public function update_double_lock(Request $req) {
        if ($req->new_setting_double_lock == "設定しない")
            $flg = 0;
        else if ($req->new_setting_double_lock == "質問")
            $flg = 1;
        else if ($req->new_setting_double_lock == "ワンタイムコード")
            $flg = 2;

        if ($flg == 1) {
            DB::table('accounts')->where('id', $req->id)->update([
                'certification_flag' => $flg,
                'question' => $req->new_question,
                'answer' => password_hash($req->new_answer, PASSWORD_DEFAULT),
                'one_time_code' => NULL
            ]);
        } else {
            DB::table('accounts')->where('id', $req->id)->update([
                'certification_flag' => $flg,
                'question' => NULL,
                'answer' => NULL,
                'one_time_code' => NULL
            ]);
        }

        return response()->json([]);
    }
}

