<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
    });

    Route::get('siswa/dashboard', function (){
        return view('siswa_dashboard');
    });

    Route::get('/siswa/list', function(){
        $listSurat = [];

        if(Auth::check()){
            $listSurat = DB::table('surats')
            ->select('*')
            ->where('user_id', '=', Auth::id())
            ->get();

        };

        return view('surat_list', ['listSurat' => $listSurat]);
    });

    Route::post('/create_surat', [suratController::class, 'create_surat']);
    


