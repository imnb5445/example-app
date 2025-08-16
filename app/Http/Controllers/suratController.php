<?php

namespace App\Http\Controllers;


use App\Models\Surat;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class suratController extends Controller
{
    use AuthorizesRequests;

    public function create_surat(Request $request){
        $data = $request -> validate([
            'tipe' => 'required|string',
            'alasan' => 'required|string|max:255',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $data['user_id'] = Auth::id();
        Surat::create($data);

        return redirect('/siswa/dashboard');
    }

    public function approvedSurat(Surat $id){
        $id->update([
        'approved' => true
        ]);

        return redirect('/admin/dashboard');
    }

    public function edit_surat(Request $request, Surat $id){
        $this->authorize('update', $id);

        $data = $request -> validate([
            'tipe' => 'required',
            'alasan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);


        $id->update($data);



        return redirect('/siswa/list');
    }

    public function delete_surat(Surat $surat){
        $this->authorize('delete', $surat); // optional: if you use policies

        $surat->delete();

        return redirect('/siswa/list')->with('success', 'Surat deleted successfully');
    }


    public function storeTtd(Request $request, Surat $id){
       $request->validate([
            'ttd_data' => 'required'
        ]);

        // Remove "data:image/png;base64," part
        $image = str_replace('data:image/png;base64,', '', $request->ttd_data);
        $image = str_replace(' ', '+', $image);

        $imageName = 'ttd_' . Str::uuid() . '.png';

        // Store in storage/app/public/signatures
        Storage::disk('public')->put('ttd/' . $imageName, base64_decode($image));

        // Save path to DB if needed
        $id->update(['ttd' => 'ttd/' . $imageName]);

        return response()->json(['success' => true, 'path' => 'signatures/' . $imageName]);
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

    public function showEditScreen($id){
        if (!Auth::check()) {
             return redirect()->back()->with('error', 'You are not allowed to view this post.');
        }
       
        $surat = DB::table('surats')
            ->select('*')
            ->where('id', '=', $id)
            ->first();

        if (!$surat) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        $suratModel = \App\Models\Surat::find($id);

        if (Auth::user()->cannot('view', $suratModel)) {
            return redirect()->back()->with('error', 'You are not allowed to view this post.');
        }
        return view('edit', ['surat' => $surat]);
    }

    public function showTtdScreen($id){
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
        return view('ttd_surat', ['surat' => $surat]);
    }
}
 