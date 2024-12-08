<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaAlphaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nim = '2241760074';

        for ($semester = 1; $semester <= 8; $semester++) {
            DB::table('m_mahasiswa_alpha')->insert([
                'ni' => $nim,
                'jam_alpha' => rand(1, 10), // Random alpha hours
                'nama' => 'Aryo Wahyu',
                'semester' => 'Semester ' . $semester,
                'jam_kompen' => null, // jam_kompen is null
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
