<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function admin_login(Request $request){
        $data = $request -> validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt(['name' => $data['name'], 'password' => $data['password']])){
            $request->session()->regenerate();
            return redirect('/admin/dashboard');
        } else {
            return redirect('/');
        };
    }

    public function admin_register(Request $request){
        $data = $request -> validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|string|email',
        ]);

        $data['name'] = strip_tags($data['name']);
        $data['email'] = strip_tags($data['email']);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'admin';
        $user = User::create($data);
        Auth::login($user);
        return redirect('/admin/dashboard');
    }

    public function admin_logout(Request $request){
        Auth::logout(); // remove user session

        // Optional: invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login'); // redirect to login or homepage
    }
}
