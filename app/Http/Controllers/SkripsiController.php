<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsis = Skripsi::with(['mahasiswa', 'dosen'])->paginate(15);
        return view('skripsi.index', compact('skripsis'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('skripsi.create', compact('mahasiswas', 'dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswas,id|unique:skripsis',
            'dosen_id' => 'required|exists:dosens,id',
            'dokumen' => 'nullable|file|mimes:pdf,docx,doc|max:5120',
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = $request->file('dokumen')->store('skripsi', 'public');
        }

        Skripsi::create($validated);
        return redirect()->route('skripsi.index')->with('success', 'Skripsi berhasil ditambahkan');
    }

    public function edit(Skripsi $skripsi)
    {
        $user = Auth::user();

        if ($user->role === 'user') {
            if (!$user->mahasiswa || $skripsi->mahasiswa_id !== $user->mahasiswa->id) {
                abort(403, 'Anda tidak berhak mengedit skripsi ini.');
            }
        }

        if ($user->role === 'admin' && $user->dosen) {
        }

        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('skripsi.edit', compact('skripsi', 'mahasiswas', 'dosens'));
    }

    public function show(Skripsi $skripsi)
    {
        return view('skripsi.show', compact('skripsi'));
    }

    public function update(Request $request, Skripsi $skripsi)
    {
        $user = Auth::user();

        $rules = [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,docx,doc|max:5120',
        ];

        if ($user->role === 'user') {
            // --- MAHASISWA ---
            $validated = $request->validate($rules);

            $validated['mahasiswa_id'] = $skripsi->mahasiswa_id;
            $validated['dosen_id'] = $skripsi->dosen_id;

            $validated['status'] = 'pending';

            $message = 'Pengajuan skripsi berhasil diperbarui dan status kembali menjadi Menunggu.';
        } else {
            // --- ADMIN / DOSEN ---
            $rules['dosen_id'] = 'required|exists:dosens,id';
            $rules['status'] = 'required|in:pending,ongoing,completed';

            if ($request->has('mahasiswa_id')) {
                $rules['mahasiswa_id'] = 'required|exists:mahasiswas,id|unique:skripsis,mahasiswa_id,' . $skripsi->id;
            }

            $validated = $request->validate($rules);

            if (!isset($validated['mahasiswa_id'])) {
                $validated['mahasiswa_id'] = $skripsi->mahasiswa_id;
            }

            $message = 'Data skripsi berhasil diperbarui.';
        }

        // UPLOAD DOKUMEN BARU (Jika ada)
        if ($request->hasFile('dokumen')) {
            // Hapus file lama jika ada
            if ($skripsi->dokumen) {
                Storage::disk('public')->delete($skripsi->dokumen);
            }
            $validated['dokumen'] = $request->file('dokumen')->store('skripsi', 'public');
        }

        // Lakukan Update
        $skripsi->update($validated);

        return redirect()->route('skripsi.index')->with('success', $message);
    }

    public function destroy(Skripsi $skripsi)
    {
        if ($skripsi->dokumen) {
            Storage::disk('public')->delete($skripsi->dokumen);
        }
        $skripsi->delete();
        return redirect()->route('skripsi.index')->with('success', 'Skripsi berhasil dihapus');
    }

    public function myProjects()
    {
        $user = Auth::user();
        
        if ($user->role === 'user' && $user->mahasiswa) {
            $skripsis = $user->mahasiswa->skripsi ? collect([$user->mahasiswa->skripsi]) : collect([]);
            return view('skripsi.my-projects', compact('skripsis'));
        } elseif ($user->role === 'admin' && $user->dosen) {
            $skripsis = $user->dosen->skripsis;
            return view('skripsi.my-projects', compact('skripsis'));
        }
        
        abort(404);
    }
}
