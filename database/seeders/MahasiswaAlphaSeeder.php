<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaAlphaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_mahasiswa_alpha')->insert([
            // User 1 - Mahasiswa
            [
                'id_alpha' => 1,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 4,
                'semester' => '1',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 2,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 6,
                'semester' => '2',
                'jam_kompen' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 3,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 8,
                'semester' => '3',
                'jam_kompen' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 4,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 3,
                'semester' => '4',
                'jam_kompen' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 5,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 5,
                'semester' => '5',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 6,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 7,
                'semester' => '6',
                'jam_kompen' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 7,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 4,
                'semester' => '7',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 8,
                'ni' => '2241760074',
                'nama' => 'Mahasiswa',
                'jam_alpha' => 2,
                'semester' => '8',
                'jam_kompen' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // User 2 - Aryo Wahyu N
            [
                'id_alpha' => 9,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 3,
                'semester' => '1',
                'jam_kompen' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 10,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 5,
                'semester' => '2',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 11,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 7,
                'semester' => '3',
                'jam_kompen' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 12,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 4,
                'semester' => '4',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 13,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 6,
                'semester' => '5',
                'jam_kompen' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 14,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 8,
                'semester' => '6',
                'jam_kompen' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 15,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 3,
                'semester' => '7',
                'jam_kompen' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 16,
                'ni' => '2241760077',
                'nama' => 'Aryo Wahyu N',
                'jam_alpha' => 2,
                'semester' => '8',
                'jam_kompen' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // User 3 - Aryo Wahyu
            [
                'id_alpha' => 17,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 5,
                'semester' => '1',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 18,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 7,
                'semester' => '2',
                'jam_kompen' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 19,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 4,
                'semester' => '3',
                'jam_kompen' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 20,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 6,
                'semester' => '4',
                'jam_kompen' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 21,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 8,
                'semester' => '5',
                'jam_kompen' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 22,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 3,
                'semester' => '6',
                'jam_kompen' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 23,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 5,
                'semester' => '7',
                'jam_kompen' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_alpha' => 24,
                'ni' => '2241760099',
                'nama' => 'Aryo Wahyu',
                'jam_alpha' => 2,
                'semester' => '8',
                'jam_kompen' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
