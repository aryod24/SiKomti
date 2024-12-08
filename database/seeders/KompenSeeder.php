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
                'UUID_Kompen' => 'a6c654e7-c8d0-47cf-9fb3-2c6da5108e57',
                'nama_kompen' => 'Kompen 1',
                'deskripsi' => 'Deskripsi Kompen 1',
                'jenis_tugas' => null,
                'quota' => 10,
                'jam_kompen' => 20,
                'status_dibuka' => true,
                'tanggal_mulai' => '2024-01-01',
                'tanggal_akhir' => '2024-01-31',
                'Is_Selesai' => false,
                'id_kompetensi' => null,
                'periode_kompen' => null,
                'nama' => 'Administrator', // This should match the `nama` in `m_user` table
                'level_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'UUID_Kompen' => Str::uuid(),
                'nama_kompen' => 'Kompen 2',
                'deskripsi' => 'Deskripsi Kompen 2',
                'jenis_tugas' => null,
                'quota' => 15,
                'jam_kompen' => 25,
                'status_dibuka' => true,
                'tanggal_mulai' => '2024-02-01',
                'tanggal_akhir' => '2024-02-28',
                'Is_Selesai' => false,
                'id_kompetensi' => null,
                'periode_kompen' => null,
                'nama' => 'Administrator',  // This should match the `nama` in `m_user` table
                'user_id' => 1,
                'level_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
            // Add more entries as needed
        ]);
    }
}
