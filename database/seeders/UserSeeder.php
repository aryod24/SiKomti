<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_user')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('12345'), 
                'nama' => 'Administrator',
                'jurusan' => null, 
                'ni' => null, 
                'level_id' => 1,
                'created_at' => now(),
                'updated_at' => '2024-12-03 18:09:07',
                'avatar' => '1733274547.jpg',
                'kelas' => null, 
                'semester' => null 
            ],
            [
                'username' => 'mahasiswa',
                'password' => Hash::make('12345'), 
                'nama' => 'Mahasiswa',
                'jurusan' => 'Informatika', 
                'ni' => '2241760074',
                'level_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'avatar' => null,
                'kelas' => 'SIB 3A', 
                'semester' => 'Semester 5' 
            ],
            [
                'username' => 'dosen',
                'password' => Hash::make('12345'), 
                'nama' => 'Dosen',
                'jurusan' => 'Sistem Informasi', 
                'ni' => '22471199238',
                'level_id' => 3,
                'created_at' => now(),
                'updated_at' => '2024-12-03 08:02:37',
                'avatar' => '1733232510.png',
                'kelas' => null, 
                'semester' => null 
            ],
            [
                'username' => 'tendik',
                'password' => Hash::make('12345'), 
                'nama' => 'Tendik',
                'jurusan' => null, 
                'ni' => null, 
                'level_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'avatar' => null,
                'kelas' => null, 
                'semester' => null 
            ],
            [
                'username' => 'aryods',
                'password' => Hash::make('12345'), 
                'nama' => 'Aryo Wahyu N',
                'jurusan' => 'Teknik Infor', 
                'ni' => '2241760077',
                'level_id' => 2,
                'created_at' => '2024-11-22 00:38:07',
                'updated_at' => '2024-11-23 23:47:26',
                'avatar' => null,
                'kelas' => 'SIB 3A', 
                'semester' => 'Semester 5' 
            ],
            [
                'username' => 'aryow',
                'password' => Hash::make('12345'), 
                'nama' => 'Aryo Wahyu',
                'jurusan' => 'Sistem Info', 
                'ni' => '2241760099',
                'level_id' => 2,
                'created_at' => '2024-11-23 07:23:31',
                'updated_at' => '2024-11-23 07:23:31',
                'avatar' => null,
                'kelas' => 'SIB 3A', 
                'semester' => 'Semester 5' 
            ]
            // Add more entries as needed
        ]);
    }
}
