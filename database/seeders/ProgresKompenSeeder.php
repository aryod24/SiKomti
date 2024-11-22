<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProgresKompenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uuid = Str::uuid()->toString();

        DB::table('t_progres_kompen')->insert([
            [
                'nama_progres' => 'Progres 1',
                'bukti_kompen' => 'bukti1.jpg',
                'UUID_Kompen' => 'a6c654e7-c8d0-47cf-9fb3-2c6da5108e57',
                'ni' => '2241760074',
                'jam_kompen' => 20,
                'status_acc' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
