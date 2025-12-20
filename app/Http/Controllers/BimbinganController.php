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

    // Menampilkan daftar mahasiswa bimbingan dosen
    public function indexDosen()
    {
        $user = Auth::user();

        // Pastikan user adalah dosen
        if (!$user->dosen) {
            abort(403, 'Akses ditolak. Anda bukan Dosen.');
        }

        // AMBIL SKRIPSI YANG BELUM DI-ACC
        // Logika: Ambil skripsi milik dosen ini, TAPI yang belum punya bimbingan statusnya 'done'
        $skripsis = Skripsi::with('mahasiswa')
            ->where('dosen_id', $user->dosen->id)
            ->whereDoesntHave('bimbingans', function ($query) {
                $query->where('status', 'done');
            })
            ->get();

        return view('bimbingan.dosen.index', compact('skripsis'));
    }

    // Menampilkan detail bimbingan & form revisi untuk Dosen
    public function showDosen(Skripsi $skripsi)
    {
        $user = Auth::user();

        // Validasi apakah skripsi ini milik bimbingan dosen tersebut
        if ($skripsi->dosen_id !== $user->dosen->id) {
            abort(403);
        }

        // Ambil riwayat bimbingan untuk ditampilkan sebagai history
        $riwayat_bimbingan = Bimbingan::where('skripsi_id', $skripsi->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bimbingan.dosen.show', compact('skripsi', 'riwayat_bimbingan'));
    }

    // Menyimpan notulen/revisi atau ACC dari Dosen
    public function store(Request $request, Skripsi $skripsi)
    {
        $user = Auth::user();

        $request->validate([
            'catatan' => 'nullable|string',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'status' => 'required|in:revisi,done', // 'done' artinya ACC
        ]);

        // Validasi input
        if (!$request->catatan && !$request->hasFile('file_surat') && $request->status == 'revisi') {
            return back()->withErrors(['catatan' => 'Harap isi catatan atau upload file jika memberikan revisi.']);
        }

        $path = null;
        if ($request->hasFile('file_surat')) {
            $path = $request->file('file_surat')->store('bimbingan_files', 'public');
        }

        // Simpan data bimbingan
        Bimbingan::create([
            'skripsi_id' => $skripsi->id,
            'dosen_id' => $user->dosen->id,
            'catatan' => $request->catatan,
            'file_surat' => $path,
            'status' => $request->status,
        ]);

        // Jika status Done (ACC), kembalikan ke index karena mahasiswa akan hilang dari list
        if ($request->status == 'done') {
            return redirect()->route('bimbingan.dosen.index')->with('success', 'Skripsi telah di-ACC. Mahasiswa dihapus dari daftar bimbingan aktif.');
        }

        return back()->with('success', 'Revisi berhasil dikirim ke mahasiswa.');
    }

    // --- HALAMAN MAHASISWA ---

    public function indexMahasiswa()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Cek jika mahasiswa atau skripsi belum ada
        if (!$mahasiswa || !$mahasiswa->skripsi) {
            return view('bimbingan.mahasiswa.index', [
                'bimbingans' => collect(),
                'skripsi' => null,
                'error' => 'Data skripsi belum ditemukan.'
            ]);
        }

        $skripsi = $mahasiswa->skripsi;

        // Ambil semua history revisi dari dosen
        $bimbingans = Bimbingan::where('skripsi_id', $skripsi->id)
            ->with('dosen')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bimbingan.mahasiswa.index', compact('bimbingans', 'skripsi'));
    }
    
    // Opsional: Jika mahasiswa masih butuh upload file balasan, pakai ini.
    // Jika hanya "melihat list revisian" sesuai request, fungsi ini tidak wajib dipanggil di view.
    public function storeMahasiswa(Request $request)
    {
        $user = Auth::user();
        if (!$user->mahasiswa || !$user->mahasiswa->skripsi) {
             return back()->with('error', 'Data tidak ditemukan');
        }
        
        $skripsi = $user->mahasiswa->skripsi;

        $request->validate([
            'catatan' => 'required|string',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $path = null;
        if ($request->hasFile('file_surat')) {
            $path = $request->file('file_surat')->store('bimbingan_files', 'public');
        }

        Bimbingan::create([
            'skripsi_id' => $skripsi->id,
            'dosen_id' => $skripsi->dosen_id,
            'catatan' => $request->catatan,
            'file_surat' => $path,
            'status' => 'pending', // Pending menunggu revisi dosen
        ]);

        return back()->with('success', 'Dokumen/Catatan terkirim ke dosen.');
    }
}