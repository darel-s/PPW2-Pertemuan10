<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;  

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // Sisipkan kode ControllerBuku di sini

    public function index(){
        $batas = 5;
        $data_buku = Buku::paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = DB::table('buku')->sum('harga');
        $jumlah_buku = $data_buku->count();
        return view('dashboard', compact('data_buku', 'total_harga', 'no', 'jumlah_buku'));
    }

    public function create() {
        return view('buku.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh melebihi :max karakter.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
        ], [
            'judul' => 'Judul Buku',
            'penulis' => 'Nama Penulis',
            'harga' => 'Harga Buku',
            'tgl_terbit' => 'Tanggal Terbit',
        ]);
        
        Buku::create($validatedData);
        
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');
    }

    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata; 
        $data_buku = Buku::where('judul', 'like', '%' . $cari . '%')
            ->orWhere('penulis', 'like', '%' . $cari . '%')
            ->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = DB::table('buku')->sum('harga');
        $jumlah_buku = $data_buku->count();
    
        return view('buku.search', compact('data_buku', 'total_harga', 'no', 'jumlah_buku', 'cari'));
    }
}
