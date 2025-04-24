<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Kelas;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::all();

        foreach ($kelas as $k) {
            for ($i = 1; $i <= 5; $i++) {
                Guru::create([
                    'nama' => 'Guru ' . $i . ' ' . $k->nama_kelas,
                    'nip' => '19870' . rand(10000, 99999),
                    'kelas_id' => $k->id,
                ]);
            }
        }
    }
}
