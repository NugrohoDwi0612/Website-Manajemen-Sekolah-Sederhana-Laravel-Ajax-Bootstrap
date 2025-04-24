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
        $kelas = Kelas::with('siswa')->get();

        $data = $kelas->map(function ($kls) {
            $siswaList = '<ul>' . $kls->siswa->map(function ($siswa) {
                return '<li>' . $siswa->nama . ' (' . $siswa->nisn . ')</li>';
            })->join('') . '</ul>';

            return [
                'kelas' => $kls->nama_kelas,
                'siswa' => $siswaList
            ];
        });

        return DataTables::of($data)
            ->rawColumns(['siswa'])->make(true);
    }

    public function getGuruPerKelas()
    {
        $kelas = Kelas::with('guru')->get();

        $data = $kelas->map(function ($kls) {
            $guruList = '<ul>' . $kls->guru->map(function ($guru) {
                return '<li>' . $guru->nama . ' (' . $guru->nip . ')</li>';
            })->join('') . '</ul>';

            return [
                'kelas' => $kls->nama_kelas,
                'guru' => $guruList
            ];
        });

        return DataTables::of($data)
            ->rawColumns(['guru'])
            ->make(true);
    }

    public function getSiswaKelasGuru()
    {
        $kelas = Kelas::with('siswa', 'guru')->get();

        $data = $kelas->map(function ($kls) {
            $siswaList = '<ul>' . $kls->siswa->map(function ($siswa) {
                return '<li>' . $siswa->nama . ' (' . $siswa->nisn . ')</li>';
            })->join('') . '</ul>';

            $guruList = '<ul>' . $kls->guru->map(function ($guru) {
                return '<li>' . $guru->nama . ' (' . $guru->nip . ')</li>';
            })->join('') . '</ul>';

            return [
                'kelas' => $kls->nama_kelas,
                'siswa' => $siswaList,
                'guru' => $guruList
            ];
        });

        return DataTables::of($data)
            ->rawColumns(['guru', 'siswa'])
            ->make(true);
    }
}
