<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('user')->paginate(15);
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        $users = User::where('role', 'admin')->whereDoesntHave('dosen')->get();
        return view('dosen.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:dosens',
            'nama' => 'required|string|max:255',
            'nip' => 'required|unique:dosens|string|max:50',
            'spesialisasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        Dosen::create($validated);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosens,nip,' . $dosen->id,
            'spesialisasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->update($validated);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }

    public function profile()
    {
        $dosen = Auth::user()->dosen;
        if (!$dosen) {
            abort(404, 'Data dosen tidak ditemukan');
        }
        return view('dosen.profile', compact('dosen'));
    }
}
