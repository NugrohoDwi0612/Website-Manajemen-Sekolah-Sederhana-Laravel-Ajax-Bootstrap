<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrangTua;

class OrangTuaSeeder extends Seeder
{
    public function run()
    {
        $orangTuas = [
            ['nama_orangtua' => 'Budi Santoso', 'no_hp' => '08123456789'],
            ['nama_orangtua' => 'Siti Aminah', 'no_hp' => '08123456780'],
            ['nama_orangtua' => 'Agus Wirawan', 'no_hp' => '08123456781'],
            ['nama_orangtua' => 'Dewi Lestari', 'no_hp' => '08123456782'],
            ['nama_orangtua' => 'Andi Pratama', 'no_hp' => '08123456783'],
        ];

        foreach ($orangTuas as $orangTua) {
            OrangTua::create($orangTua);
        }
    }
}
