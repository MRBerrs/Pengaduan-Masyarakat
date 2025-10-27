<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengaduan dengan pencarian (opsional)
        $search = request('search');
        $pengaduan = Pengaduan::when($search, function ($query, $search) {
            return $query->where('isi_laporan', 'like', "%{$search}%")
                         ->orWhere('status', 'like', "%{$search}%");
        })->paginate(10);

        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengaduan = new Pengaduan();
        $pengaduan->tgl_pengaduan = now();
        $pengaduan->nik = Auth::user()->nik; // Mengambil NIK dari pengguna yang sedang login
        $pengaduan->isi_laporan = $request->isi_laporan;

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fileName);
            $pengaduan->foto = $fileName;
        }

        $pengaduan->status = 'pending';
        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->foto) {
            unlink(public_path('uploads/' . $pengaduan->foto));
        }
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    /**
     * Update the status of a pengaduan to resolved.
     */
    public function resolve(Pengaduan $pengaduan)
    {
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan telah diselesaikan.');
    }
}
