<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDonasi extends Model
{
    protected $table = 'user_donasis';
    protected $fillable = [
        'userId',
        'donasiId',
        'nominal',
        'waktu_donasi',
        'metode'
    ];
}
