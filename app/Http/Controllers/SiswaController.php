<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::with(['kelas', 'orangTua'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kelas', function ($row) {
                    return $row->kelas->nama_kelas ?? '-';
                })
                ->addColumn('orang_tua', function ($row) {
                    return $row->orangTua->nama_orangtua ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm editSiswa">Edit</a> ';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteSiswa">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $kelas = Kelas::all();
        $orangtua = OrangTua::all();
        return view('siswa.index', compact('kelas', 'orangtua'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|numeric|unique:siswas,nisn',
            'kelas_id' => 'required|exists:kelas,id',
            'orangtua_id' => 'required|exists:orang_tuas,id',
        ]);

        try {

            Siswa::create([
                'nama' => $validated['nama'],
                'nisn' => $validated['nisn'],
                'kelas_id' => $validated['kelas_id'],
                'orangtua_id' => $validated['orangtua_id'],
            ]);

            return response()->json(['success' => 'Data siswa berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }



    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:siswas,nisn,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
            'orangtua_id' => 'required|exists:orang_tuas,id',
        ]);

        $siswa->update($validated);

        return response()->json(['success' => 'Siswa berhasil diperbarui.']);
    }


    public function destroy($id)
    {
        try {
            Siswa::find($id)->delete();
            return response()->json(['success' => 'Data siswa berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
