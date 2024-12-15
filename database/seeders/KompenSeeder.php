<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KompenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_kompen')->insert([
            [
                'UUID_Kompen' => '0b4639b8-b726-4471-8d1e-7cf334290e73',
                'nama_kompen' => 'Kompen A',
                'deskripsi' => 'Kompen Dosen Ditutup',
                'jenis_tugas' => 3,
                'quota' => 2,
                'jam_kompen' => 2,
                'status_dibuka' => 0,
                'tanggal_mulai' => '2024-11-23',
                'tanggal_akhir' => '2024-11-28',
                'Is_Selesai' => 0,
                'id_kompetensi' => 8,
                'periode_kompen' => null,
                'nama' => 'Dosen',
                'user_id' => 3,
                'level_id' => 3,
                'created_at' => '2024-11-22 21:18:34',
                'updated_at' => '2024-12-04 07:02:51'
            ],
            [
                'UUID_Kompen' => '2371e6e5-d5ba-4cc7-a329-86bab786457f',
                'nama_kompen' => 'Kompen B',
                'deskripsi' => 'Kompen Dosen B',
                'jenis_tugas' => 2,
                'quota' => 2,
                'jam_kompen' => 10,
                'status_dibuka' => 1,
                'tanggal_mulai' => '2024-11-12',
                'tanggal_akhir' => '2024-11-14',
                'Is_Selesai' => 0,
                'id_kompetensi' => 8,
                'periode_kompen' => '1212',
                'nama' => 'Dosen',
                'user_id' => 3,
                'level_id' => 3,
                'created_at' => '2024-12-09 07:50:22',
                'updated_at' => '2024-12-09 07:50:22'
            ],
            [
                'UUID_Kompen' => '5a4adcf0-ea21-4b5b-b022-2d196f518f79',
                'nama_kompen' => 'Kompen C',
                'deskripsi' => 'Kompen Dosen Dibuka',
                'jenis_tugas' => 3,
                'quota' => 2,
                'jam_kompen' => 15,
                'status_dibuka' => 1,
                'tanggal_mulai' => '2024-11-23',
                'tanggal_akhir' => '2024-11-29',
                'Is_Selesai' => 1,
                'id_kompetensi' => 6,
                'periode_kompen' => null,
                'nama' => 'Dosen',
                'user_id' => 3,
                'level_id' => 3,
                'created_at' => '2024-11-22 21:18:00',
                'updated_at' => '2024-11-23 23:01:13'
            ],
            [
                'UUID_Kompen' => 'a6c654e7-c8d0-47cf-9fb3-2c6da5108e57',
                'nama_kompen' => 'Kompen D',
                'deskripsi' => 'Kompen D Admin',
                'jenis_tugas' => 1,
                'quota' => 10,
                'jam_kompen' => 20,
                'status_dibuka' => 1,
                'tanggal_mulai' => '2024-01-01',
                'tanggal_akhir' => '2024-01-31',
                'Is_Selesai' => 0,
                'id_kompetensi' => 1,
                'periode_kompen' => null,
                'nama' => 'Administrator',
                'user_id' => 1,
                'level_id' => 1,
                'created_at' => '2024-11-22 00:36:36',
                'updated_at' => '2024-11-22 00:39:55'
            ],
            [
                'UUID_Kompen' => 'e503d618-0f49-4c29-b343-4399113c0e99',
                'nama_kompen' => 'Kompen E',
                'deskripsi' => 'Kompen E Admin',
                'jenis_tugas' => 2,
                'quota' => 15,
                'jam_kompen' => 25,
                'status_dibuka' => 1,
                'tanggal_mulai' => '2024-02-01',
                'tanggal_akhir' => '2024-02-28',
                'Is_Selesai' => 0,
                'id_kompetensi' => 4,
                'periode_kompen' => null,
                'nama' => 'Administrator',
                'user_id' => 1,
                'level_id' => 1,
                'created_at' => '2024-11-22 00:36:36',
                'updated_at' => '2024-11-22 00:53:55'
            ]
            // Add more entries as needed
        ]);
    }
}
