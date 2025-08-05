<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\suratController;



    Route::get('/', function () {
        return view('siswa_login');
    })->name('login');

    Route::post('/siswa_login', [siswaController::class, 'siswa_login']);

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/siswa/input', function () {
            return view('input');
        })->name('siswa.dashboard');

        Route::post('/create_surat', [suratController::class, 'create_surat']);
    });



