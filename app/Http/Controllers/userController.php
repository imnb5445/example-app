<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
     public function login(Request $request){
        $data = $request -> validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt(['name' => $data['name'], 'password' => $data['password']])){
            $request->session()->regenerate();
            if (Auth::user()-> role == "admin") {
                return redirect('/admin/dashboard');
            } else if(Auth::user()-> role == "siswa") {
                return redirect('/siswa/dashboard');
            }
        } else {
            return redirect('/');
        };

        
    }
    public function logout(Request $request){
        Auth::logout(); // remove user session

        // Optional: invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // redirect to login or homepage
    }
}
