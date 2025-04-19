<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm editKelas">Edit</a> ';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteKelas">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kelas.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        try {
            Kelas::updateOrCreate(
                ['id' => $request->kelas_id],
                ['nama_kelas' => $validated['nama_kelas']]
            );

            return response()->json(['success' => 'Data kelas berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->update([
                'nama_kelas' => $validated['nama_kelas'],
            ]);

            return response()->json(['success' => 'Data kelas berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        Kelas::find($id)->delete();
        return response()->json(['success' => 'Data kelas berhasil dihapus.']);
    }
}