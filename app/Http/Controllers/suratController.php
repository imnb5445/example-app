<?php

namespace App\Http\Controllers;


use App\Models\Surat;
use Illuminate\Http\Request;

class suratController extends Controller
{
    public function create_surat(Request $request){
        $data = $request -> validate([
            'type' => 'required',
            'alasan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $data['alasan'] = strip_tags($data['alasan']);
        $data['nis'] = auth('siswa')->user()->nis;
        Surat::create($data);
    }
}
 