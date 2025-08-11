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
            'name'          => 'required|string|max:255',
            'password'      => 'required|string',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'nis'           => 'required|string|max:4',
            'nisn'          => 'required|string|max:10',
            'nama_lengkap'  => 'required|string|max:255',
            'kelas'         => 'required|string',
            'no_ortu'       => 'required|string|max:20'
        ]);

        // Remove all HTML/PHP tags from all string values
        $data = array_map(function ($value) {
            return is_string($value) ? strip_tags($value) : $value;
        }, $data);


        $credential = [
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
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
        
        $user = User::create($credential);
        $userId = $user->id;
        $siswaData['user_id'] = $userId;
        Siswa::create($siswaData);

        Auth::login($user);
        return redirect('/siswa/dashboard');
    }

    public function siswa_logout(Request $request){
        Auth::logout(); // remove user session

        // Optional: invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // redirect to login or homepage
    }
}
