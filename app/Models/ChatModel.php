<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    use HasFactory;

    protected $table = 'chat';
    protected $fillable = [
        'room_no',
        'account_id',
        'to_id',
        'message',
        'time',
        'open',
        'created_at',
        'updated_at'
    ];
}
