<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrangtuaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = OrangTua::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm editorangtua">Edit</a> ';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteorangtua">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('orang-tua.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            OrangTua::updateOrCreate(
                ['id' => $request->orangtua_id],
                [
                    'nama_orangtua' => $validated['nama_orangtua'],
                    'no_hp' => $validated['no_hp']
                ]
            );

            return response()->json(['success' => 'Data orang tua berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $orangtua = OrangTua::find($id);
        return response()->json($orangtua);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            $orangtua = OrangTua::findOrFail($id);
            $orangtua->update([
                'nama_orangtua' => $validated['nama_orangtua'],
                'no_hp' => $validated['no_hp'],
            ]);

            return response()->json(['success' => 'Data orang tua berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        OrangTua::find($id)->delete();
        return response()->json(['success' => 'Data orang tua berhasil dihapus.']);
    }
}
