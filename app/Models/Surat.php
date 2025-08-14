<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
     protected $fillable = [
        'tipe',
        'alasan',
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'approved',
        'ttd'
    ];
}
