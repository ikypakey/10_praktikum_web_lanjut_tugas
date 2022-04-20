<?php

namespace Database\Seeders;

use App\Models\Mahasiwa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this ->call([KelasSeeder::class,MataKuliahSeeder::class,MahasiwaSeeder::class,UpdateMahasiswaSeeder::class,NilaiSeeder::class]);
    }
}
