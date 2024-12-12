<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgresKompenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_progres_kompen')->insert([
            [
                'id_progres' => 8,
                'nama_progres' => 'adad',
                'bukti_kompen' => 'polinema.png',
                'UUID_Kompen' => '5a4adcf0-ea21-4b5b-b022-2d196f518f79',
                'ni' => '2241760077',
                'nama' => 'Aryods',
                'jam_kompen' => 15,
                'status_acc' => 1,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-11-23 22:07:24',
                'updated_at' => '2024-12-03 07:07:35',
            ],
            [
                'id_progres' => 10,
                'nama_progres' => 'Iya',
                'bukti_kompen' => '1733105444_logonew.png.png',
                'UUID_Kompen' => '0b4639b8-b726-4471-8d1e-7cf334290e73',
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_kompen' => 2,
                'status_acc' => 0,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-11-24 21:45:17',
                'updated_at' => '2024-12-01 19:10:44',
            ],
            [
                'id_progres' => 11,
                'nama_progres' => null,
                'bukti_kompen' => null,
                'UUID_Kompen' => 'e503d618-0f49-4c29-b343-4399113c0e99',
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_kompen' => 25,
                'status_acc' => null,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-12-02 06:15:01',
                'updated_at' => '2024-12-02 06:15:01',
            ],
            [
                'id_progres' => 12,
                'nama_progres' => null,
                'bukti_kompen' => null,
                'UUID_Kompen' => '5a4adcf0-ea21-4b5b-b022-2d196f518f79',
                'ni' => '2241760099',
                'nama' => 'Test data',
                'jam_kompen' => 15,
                'status_acc' => 1,
                'kelas' => null, // Adding kelas as null
                'semester' => null, // Adding semester as null
                'created_at' => '2024-12-02 06:21:04',
                'updated_at' => '2024-12-03 07:05:34',
            ],
        ]);
    }
}
