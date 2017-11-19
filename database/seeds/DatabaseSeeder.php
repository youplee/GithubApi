<?php

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
        
        $this->call(UsersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(RecherchesTableSeeder::class);

        // // factory(App\Profil::class, 6)->create();
        // factory(App\Pack::class, 6)->create();
        // factory(App\HabilitationPack::class, 6)->create();
        
    }
}
