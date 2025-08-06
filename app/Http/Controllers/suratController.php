<?php

namespace App\Http\Controllers;


use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class suratController extends Controller
{
    public function create_surat(Request $request){
        $data = $request -> validate([
            'tipe' => 'required',
            'alasan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $data['alasan'] = strip_tags($data['alasan']);
        $data['user_id'] = Auth::id();
        Surat::create($data);
    }
}
 