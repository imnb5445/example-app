<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'kelas',
        'no_ortu',
        'user_id'
    ];

}
