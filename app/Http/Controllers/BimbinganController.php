<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BimbinganController extends Controller
{
    // --- HALAMAN DOSEN ---

    // Menampilkan daftar mahasiswa bimbingan dosen tersebut
    public function indexDosen()
    {
        $user = Auth::user();

        // Pastikan user adalah admin/dosen
        if (!$user->dosen) {
            abort(403, 'Akses ditolak. Anda bukan Dosen.');
        }

        // Ambil skripsi yang dosen_id nya sama dengan dosen yang login
        $skripsis = Skripsi::with('mahasiswa')
            ->where('dosen_id', $user->dosen->id)
            ->get();

        return view('bimbingan.dosen.index', compact('skripsis'));
    }

    // Menampilkan detail bimbingan & form tambah notulen
    public function showDosen(Skripsi $skripsi)
    {
        $user = Auth::user();

        // Validasi apakah skripsi ini milik bimbingan dosen tersebut
        if ($skripsi->dosen_id !== $user->dosen->id) {
            abort(403);
        }

        // Ambil riwayat bimbingan
        $riwayat_bimbingan = Bimbingan::where('skripsi_id', $skripsi->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bimbingan.dosen.show', compact('skripsi', 'riwayat_bimbingan'));
    }

    // Menyimpan notulen/revisi dari Dosen
    public function store(Request $request, Skripsi $skripsi)
    {
        $user = Auth::user();

        $request->validate([
            'catatan' => 'nullable|string',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'status' => 'required|in:revisi,done',
        ]);

        // Validasi minimal ada catatan atau file
        if (!$request->catatan && !$request->hasFile('file_surat')) {
            return back()->withErrors(['catatan' => 'Harap isi catatan atau upload file.']);
        }

        $path = null;
        if ($request->hasFile('file_surat')) {
            $path = $request->file('file_surat')->store('bimbingan_files', 'public');
        }

        Bimbingan::create([
            'skripsi_id' => $skripsi->id,
            'dosen_id' => $user->dosen->id,
            'catatan' => $request->catatan,
            'file_surat' => $path,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Bimbingan berhasil dikirim ke mahasiswa.');
    }

    // --- HALAMAN MAHASISWA ---

    public function indexMahasiswa()
    {
        $user = Auth::user();
        $skripsi = $user->mahasiswa->skripsi;

        $bimbingans = Bimbingan::where('skripsi_id', $skripsi->id)
            ->with('dosen')
            ->get();


        return view('bimbingan.mahasiswa.index', compact('bimbingans', 'skripsi'));
    }

public function storeMahasiswa(Request $request)
{
    $user = Auth::user();
    
    // Pastikan user adalah mahasiswa yang punya skripsi
    if (!$user->mahasiswa || !$user->mahasiswa->skripsi) {
        return back()->with('error', 'Anda belum memiliki data skripsi.');
    }

    $skripsi = $user->mahasiswa->skripsi;

    $request->validate([
        'catatan' => 'required|string',
        'file_surat' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
    ]);

    $path = null;
    if ($request->hasFile('file_surat')) {
        $path = $request->file('file_surat')->store('bimbingan_files', 'public');
    }

    // Buat data bimbingan baru dengan status 'pending' (menunggu feedback dosen)
    Bimbingan::create([
        'skripsi_id' => $skripsi->id,
        'dosen_id' => $skripsi->dosen_id,
        'catatan' => $request->catatan,
        'file_surat' => $path,
        'status' => 'pending', 
    ]);

    return back()->with('success', 'Progress bimbingan berhasil dikirim ke dosen.');
}
}
