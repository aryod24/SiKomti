<?php

namespace Database\Seeders;

use App\Models\MahasiswaAlpha;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            JenisTugasSeeder::class,
            BidangKompetensiSeeder::class,
            KompenSeeder::class,
            MahasiswaAlphaSeeder::class,
            MahasiswaKompenSeeder::class,
            ProgresKompenSeeder::class,
        ]);
    }
}
