<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Menampilkan data guru
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Guru::with('kelas')->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('kelas', function ($row) {
                    return $row->kelas->nama_kelas; // Menampilkan nama kelas
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm editGuru">Edit</a> ';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteGuru">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Mengambil daftar kelas untuk dropdown
        $kelas = Kelas::all();
        return view('guru.index', compact('kelas'));
    }

    // Menyimpan data guru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:gurus,nip',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        try {
            Guru::create([
                'nama' => $validated['nama'],
                'nip' => $validated['nip'],
                'kelas_id' => $validated['kelas_id'],
            ]);

            return response()->json(['success' => 'Data guru berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Menampilkan data guru untuk edit
    public function edit($id)
    {
        $guru = Guru::find($id);
        return response()->json($guru);
    }

    // Mengupdate data guru
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:gurus,nip,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        try {
            $guru = Guru::findOrFail($id);
            $guru->update([
                'nama' => $validated['nama'],
                'nip' => $validated['nip'],
                'kelas_id' => $validated['kelas_id'],
            ]);

            return response()->json(['success' => 'Data guru berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Menghapus data guru
    public function destroy($id)
    {
        try {
            Guru::find($id)->delete();
            return response()->json(['success' => 'Data guru berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}