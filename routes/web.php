<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\suratController;


// user siswa
Route::middleware(['auth', 'role:siswa'])->group(function () {
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

    Route::get('/surat/view', function (){
        $listSurat = [];

        $listSurat =  DB::table('users')
            ->join('surats', 'users.id', '=', 'surats.user_id')
            ->join('siswas', 'users.id', '=', 'siswas.user_id')
            ->select('users.*', 'surats.*', 'siswas.*')
            ->get();

        return view('admin_dashboard', ['listSurat' => $listSurat]);
    });

    Route::post('/create_surat', [suratController::class, 'create_surat']);

    Route::get('/surat/edit/{id}', [suratController::class, 'showEditScreen']);

    Route::put('/surat/edit/{id}', [suratController::class, 'edit_surat']);

    Route::delete('/surat/delete/{surat}', [suratController::class, 'delete_surat']);

    Route::post('/surat/download/{id}', [suratController::class, 'download_surat']);
    
});
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('siswa_login');
    })->name('login');

    Route::get('/register', function (){
        return view("siswa_register");
    });

    Route::post('/siswa_login', [siswaController::class, 'siswa_login']);

    Route::post('/siswa_register', [siswaController::class, 'siswa_register']);

    Route::post('/siswa_logout', [siswaController::class, 'siswa_logout']);

    
    
    


//user admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function (){
        $listSurat = [];

        $listSurat =  DB::table('users')
            ->join('surats', 'users.id', '=', 'surats.user_id')
            ->join('siswas', 'users.id', '=', 'siswas.user_id')
            ->select('users.*', 'surats.*', 'siswas.*')
            ->get();

        return view('admin_dashboard', ['listSurat' => $listSurat]);
    });

    

    Route::get('/admin/review_screen/{id}', [suratController::class, 'showReviewScreen']);
    Route::put('/admin/approved/{id}', [suratController::class, 'approvedSurat']);

});
    Route::get('/admin/login', function(){
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('admin_login');
    });

    Route::get('/admin/register', function(){
        return view('admin_register');
    });

    Route::post('/admin_login', [adminController::class, 'admin_login']);

    Route::post('/admin_logout', [adminController::class, 'admin_logout']);

    Route::post('/admin_register', [adminController::class, 'admin_register']);

   
    Route::get('/surat_ttd/{id}', [suratController::class, 'showTtdScreen']);
    Route::put('/surat_ttd/{id}', [suratController::class, 'storeTtd']);
