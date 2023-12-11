<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoomModel extends Model
{
    use HasFactory;

    protected $table = 'chat_room';
    protected $fillable = [
        'room_no',
        'account_id',
        'from_id',
        'created_at',
        'updated_at'
    ];
}
