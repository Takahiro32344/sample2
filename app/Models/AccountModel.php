<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $fillable = [
        'birthday',
        'address_1',
        'address_2',
        'name',
        'email',
        'tel',
        'password',
        'login_status',
        'certification_flag',
        'publish_email',
        'publish_tel',
        'question',
        'answer',
        'one_time_code',
        'update_image_name',
        'created_at',
        'updated_at'
    ];
}
