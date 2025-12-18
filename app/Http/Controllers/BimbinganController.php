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

        // Cek apakah mahasiswa punya skripsi
        if (!$user->mahasiswa || !$user->mahasiswa->skripsi) {
            return redirect()->route('dashboard')->with('error', 'Anda belum mengajukan skripsi.');
        }

        $skripsi = $user->mahasiswa->skripsi;

        // Ambil riwayat bimbingan
        $bimbingans = Bimbingan::where('skripsi_id', $skripsi->id)
            ->with('dosen')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bimbingan.mahasiswa.index', compact('bimbingans', 'skripsi'));
    }
}
