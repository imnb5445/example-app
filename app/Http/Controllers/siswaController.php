<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Login;

class siswaController extends Controller
{
    public function siswa_login(Request $request){
        $data = $request -> validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt(['name' => $data['name'], 'password' => $data['password']])){
            $request->session()->regenerate();
            return redirect('/siswa/dashboard');
        } else {
            return redirect('/');
        };
    }

    public function siswa_register(Request $request){
        $data = $request -> validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'no_ortu' => 'required'
        ]);

        $credential = [
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email'],
            'role' => 'siswa'
        ];
        
        $siswaData = [
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'nama' => $data['nama_lengkap'],
            'kelas' => $data['kelas'],
            'no_ortu' => $data['no_ortu']
        ];
        
       $credential['password'] = bcrypt($credential['password']);
       $user = User::create($credential);
       $userId = $user->id;
       $siswaData['user_id'] = $userId;
       Siswa::create($siswaData);
       Auth::login($user);
        return redirect('/siswa/dashboard');
    }
}
