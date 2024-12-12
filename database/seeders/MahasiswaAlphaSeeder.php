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
        DB::table('m_mahasiswa_alpha')->insert([
            [
                'id_alpha' => 1,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 11,
                'semester' => '1',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:41:46'
            ],
            [
                'id_alpha' => 2,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 9,
                'semester' => '2',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:14:22'
            ],
            [
                'id_alpha' => 3,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 1,
                'semester' => '3',
                'jam_kompen' => 2,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:41:51'
            ],
            [
                'id_alpha' => 4,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 2,
                'semester' => '4',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:14:37'
            ],
            [
                'id_alpha' => 5,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 5,
                'semester' => '5',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:41:19'
            ],
            [
                'id_alpha' => 6,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 10,
                'semester' => '6',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:41:24'
            ],
            [
                'id_alpha' => 7,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 7,
                'semester' => '7',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:41:28'
            ],
            [
                'id_alpha' => 8,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 8,
                'semester' => '8',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 00:36:25',
                'updated_at' => '2024-12-03 18:41:37'
            ],
            [
                'id_alpha' => 10,
                'ni' => '2241760077',
                'nama' => null,
                'jam_alpha' => 1,
                'semester' => '1',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 07:23:55',
                'updated_at' => '2024-11-22 07:23:55'
            ],
            [
                'id_alpha' => 11,
                'ni' => '2241760077',
                'nama' => null,
                'jam_alpha' => 2,
                'semester' => '2',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 07:24:21',
                'updated_at' => '2024-11-22 07:24:21'
            ],
            [
                'id_alpha' => 12,
                'ni' => '2241760077',
                'nama' => null,
                'jam_alpha' => 2,
                'semester' => '5',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 07:27:05',
                'updated_at' => '2024-11-22 07:27:05'
            ],
            [
                'id_alpha' => 13,
                'ni' => '2241760077',
                'nama' => null,
                'jam_alpha' => 3,
                'semester' => '4',
                'jam_kompen' => null,
                'created_at' => '2024-11-22 07:30:08',
                'updated_at' => '2024-11-22 07:30:08'
            ],
            [
                'id_alpha' => 14,
                'ni' => '2241760077',
                'nama' => 'Wahyu Nu',
                'jam_alpha' => 10,
                'semester' => '5',
                'jam_kompen' => 5,
                'created_at' => '2024-11-23 21:35:54',
                'updated_at' => '2024-11-30 07:27:00'
            ],
            [
                'id_alpha' => 15,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu2',
                'jam_alpha' => 2,
                'semester' => '1',
                'jam_kompen' => null,
                'created_at' => '2024-11-30 07:29:53',
                'updated_at' => '2024-11-30 07:29:53'
            ]
            // Add more entries as needed
        ]);
    }
}
