<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
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
}
