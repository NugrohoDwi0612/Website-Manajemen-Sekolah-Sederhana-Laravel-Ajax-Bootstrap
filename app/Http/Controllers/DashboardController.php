<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahGuru = Guru::count();

        return view('dashboard', compact('jumlahSiswa', 'jumlahKelas', 'jumlahGuru'));
    }
}