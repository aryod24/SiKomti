<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MahasiswaKompenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_mahasiswa_kompen')->insert([
            [
                'ni' => '2241760074', // Sesuaikan dengan data di UserSeeder
                'nama' => 'Aryods',
                'UUID_Kompen' => 'a6c654e7-c8d0-47cf-9fb3-2c6da5108e57', // Ubah sesuai UUID di t_kompen
                'status_Acc' => 0
            ],
        ]);
    }
}
