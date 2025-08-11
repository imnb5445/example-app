<?php

namespace App\Http\Controllers;


use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class suratController extends Controller
{
    public function create_surat(Request $request){
        $data = $request -> validate([
            'tipe' => 'required',
            'alasan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $data['alasan'] = strip_tags($data['alasan']);
        $data['user_id'] = Auth::id();
        Surat::create($data);
    }

    public function approvedSurat(Surat $id){
        $id->update([
        'approved' => true
        ]);

        return redirect('/admin/dashboard');
    }

    public function showReviewScreen($id){
        if (!Auth::check()) {
             return redirect()->back()->with('error', 'You are not allowed to view this post.');
        }
       
        $surat = DB::table('users')
            ->join('surats', 'users.id', '=', 'surats.user_id')
            ->join('siswas', 'users.id', '=', 'siswas.user_id')
            ->select('users.*', 'surats.*', 'siswas.*')
            ->where('surats.id', '=', $id)
            ->first();

        if (!$surat) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        $suratModel = \App\Models\Surat::find($id);

        if (Auth::user()->cannot('view', $suratModel)) {
            return redirect()->back()->with('error', 'You are not allowed to view this post.');
        }
        return view('admin_review', ['surat' => $surat]);
    }
}
 