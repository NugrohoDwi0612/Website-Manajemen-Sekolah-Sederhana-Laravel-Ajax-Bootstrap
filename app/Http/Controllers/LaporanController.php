<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function siswaPerKelas()
    {
        return view('laporan.siswa_per_kelas');
    }

    public function guruPerKelas()
    {
        return view('laporan.guru_per_kelas');
    }

    public function siswaKelasGuru()
    {
        return view('laporan.siswa_kelas_guru');
    }

    public function getSiswaPerKelas()
    {
        $data = Siswa::with('kelas')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kelas', fn($row) => $row->kelas->nama_kelas ?? '-')
            ->make(true);
    }

    public function getGuruPerKelas()
    {
        $data = Guru::with('kelas')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kelas', fn($row) => $row->kelas->nama_kelas ?? '-')
            ->make(true);
    }

    public function getSiswaKelasGuru()
    {
        $data = Siswa::with('kelas.guru')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kelas', fn($row) => $row->kelas->nama_kelas ?? '-')
            ->addColumn('guru', function ($row) {
                if ($row->kelas && $row->kelas->guru) {
                    return $row->kelas->guru->pluck('nama')->implode(', ');
                }
                return '-';
            })
            ->make(true);
    }
}
