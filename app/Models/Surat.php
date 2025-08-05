<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
     protected $fillable = [
        'tipe',
        'alasan',
        'nis',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
}
