<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteListModel extends Model
{
    use HasFactory;

    protected $table = 'favorite_list';
    protected $fillable = [
        'account_id',
        'list_id',
        'created_at',
        'updated_at'
    ];
}
