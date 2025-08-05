<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class siswaController extends Controller
{
    public function siswa_login(Request $request){
        $data = $request -> validate([
            'nisn' => 'required',
            'nis' => 'required'
        ]);
        
        $siswa = Siswa::where('nis', $data['nis'])->first();

        if ($siswa && $siswa->nisn === $data['nisn']) {
            Auth::guard('siswa')->login($siswa);
            // return auth('siswa')->user()->nis;
            return redirect('/siswa/input');
        } else {
             return back()->withErrors([
                'nisn' => 'NISN atau NIS salah.',
            ]);
        };

     
    }
}
