<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bullentin_BoardModel extends Model
{
    use HasFactory;

    protected $table = 'bullentin_board';
    protected $fillable = [
        'user_id',
        'text',
        'date',
        'created_at',
        'updated_at'
    ];
}

