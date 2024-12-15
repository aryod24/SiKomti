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
                'id_MahasiswaKompen' => 1,
                'ni' => '2241760074',
                'nama' => null,
                'UUID_Kompen' => 'a6c654e7-c8d0-47cf-9fb3-2c6da5108e57',
                'status_Acc' => 1,
                'kelas' => 'SIB 3A', // Adding kelas as null
                'semester' => 'Semester 5', // Adding semester as null
                'created_at' => now(),
                'updated_at' => '2024-12-02 06:35:32'
            ],
            [
                'id_MahasiswaKompen' => 19,
                'ni' => '2241760077',
                'nama' => 'Aryods',
                'UUID_Kompen' => '5a4adcf0-ea21-4b5b-b022-2d196f518f79',
                'status_Acc' => 1,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => now(),
                'updated_at' => '2024-11-23 22:07:24'
            ],
            [
                'id_MahasiswaKompen' => 20,
                'ni' => '2241760099',
                'nama' => 'Test data',
                'UUID_Kompen' => '5a4adcf0-ea21-4b5b-b022-2d196f518f79',
                'status_Acc' => 1,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-11-23 07:24:07',
                'updated_at' => '2024-12-02 06:21:04'
            ],
            [
                'id_MahasiswaKompen' => 22,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'UUID_Kompen' => 'a6c654e7-c8d0-47cf-9fb3-2c6da5108e57',
                'status_Acc' => 0,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-11-24 21:33:29',
                'updated_at' => '2024-12-02 06:35:41'
            ],
            [
                'id_MahasiswaKompen' => 23,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'UUID_Kompen' => '0b4639b8-b726-4471-8d1e-7cf334290e73',
                'status_Acc' => 1,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-11-24 21:44:12',
                'updated_at' => '2024-12-02 06:20:10'
            ],
            [
                'id_MahasiswaKompen' => 30,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'UUID_Kompen' => 'e503d618-0f49-4c29-b343-4399113c0e99',
                'status_Acc' => 1,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-12-01 01:10:30',
                'updated_at' => '2024-12-02 06:36:59'
            ],
            [
                'id_MahasiswaKompen' => 31,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'UUID_Kompen' => '5a4adcf0-ea21-4b5b-b022-2d196f518f79',
                'status_Acc' => 0,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-12-02 06:22:47',
                'updated_at' => '2024-12-02 06:42:36'
            ]
            // Add more entries as needed
        ]);
    }
}
