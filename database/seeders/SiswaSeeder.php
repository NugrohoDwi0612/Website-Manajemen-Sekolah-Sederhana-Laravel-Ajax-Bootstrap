<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::all();

        foreach ($kelas as $k) {
            for ($i = 1; $i <= 5; $i++) {
                Siswa::create([
                    'nama' => 'Siswa ' . $i . ' ' . $k->nama_kelas,
                    'nisn' => rand(100000, 999999),
                    'kelas_id' => $k->id,
                ]);
            }
        }
    }
}