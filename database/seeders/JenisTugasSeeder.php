<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_jenis_tugas')->insert([
            ['jenis_tugas' => 'Penelitian'],
            ['jenis_tugas' => 'Pengabdian'],
            ['jenis_tugas' => 'Teknis']
        ]);
    }
}
