<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasis';
    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'tingkatan',
        'tgl_mulai',
        'tgl_selesai',
        'target',
        'jumlah_kini',
        'status',
        'foto',
        'nama_bank',
        'no_rek'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\UserDonasi', 'user_donasis', 'donasiId', 'userId')
                    ->withPivot('nominal', 'waktu_donasi', 'metode')
                    ->withTimestamps();
    }
}
