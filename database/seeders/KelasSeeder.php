<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = ['X RPL', 'XI RPL', 'XII RPL'];

        foreach ($kelas as $k) {
            Kelas::create([
                'nama_kelas' => $k,
            ]);
        }
    }
}