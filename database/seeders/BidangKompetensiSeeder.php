<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangKompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_bidang_kompetensi')->insert([
            // Jenis Tugas 1
            ['nama_kompetensi' => 'Pemrograman Dasar', 'id_tugas' => 1],
            ['nama_kompetensi' => 'Database Fundamental', 'id_tugas' => 1],
            ['nama_kompetensi' => 'Pengembangan Web', 'id_tugas' => 1],
            
            // Jenis Tugas 2
            ['nama_kompetensi' => 'Jaringan Komputer', 'id_tugas' => 2],
            ['nama_kompetensi' => 'Sistem Operasi', 'id_tugas' => 2],
            ['nama_kompetensi' => 'Analisis dan Desain Sistem', 'id_tugas' => 2],

            // Jenis Tugas 3
            ['nama_kompetensi' => 'Keamanan Informasi', 'id_tugas' => 3],
            ['nama_kompetensi' => 'Pengolahan Data', 'id_tugas' => 3],
            ['nama_kompetensi' => 'Pemrograman Mobile', 'id_tugas' => 3],
            ['nama_kompetensi' => 'Kecerdasan Buatan', 'id_tugas' => 3],
        ]);
    }
}
