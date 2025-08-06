<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\suratController;



    Route::get('/', function () {
        return view('siswa_login');
    })->name('login');

    Route::get('/register', function (){
        return view("siswa_register");
    });

    Route::post('/siswa_login', [siswaController::class, 'siswa_login']);

    Route::post('/siswa_register', [siswaController::class, 'siswa_register']);
    
    Route::get('/siswa/input', function () {
            return view('input');
    })->name('siswa.dashboard');

    Route::post('/create_surat', [suratController::class, 'create_surat']);
    


