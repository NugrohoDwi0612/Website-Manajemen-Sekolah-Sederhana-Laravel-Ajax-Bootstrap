<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::with(['siswa', 'guru'])->get();

        return view('laporan.index', compact('kelasList'));
    }
}