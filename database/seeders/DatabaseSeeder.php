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
            $this->call([
            KelasSeeder::class,
            UpdateMahasiswaSeeder::class,
            MataKuliahSeeder::class,

        ]);
        
        Mahasiwa::create([
            'nim' => '2041720007',
            'nama' => 'Muhammad Dina',
            'foto' => 'default.png',
            'kelas_id' => 5,
            'jurusan' => 'Teknik Elektro',
            'email'=> 'akunkuliah140@gmail.com',
            'alamat'=> 'Sidoarjo',
            'tanggal_lahir' => '2001-09-09'
            
        ]);
        $this->call([

            NilaiSeeder::class,
        ]);

       

    }
}
