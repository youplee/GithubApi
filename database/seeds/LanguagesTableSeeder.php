<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages   = [
                    ['libelle'  => 'PHP', 'description'  => 'PHP', 'active' => 1 ],
                    ['libelle'  => 'CSS', 'description'  => 'CSS', 'active' => 1 ],
                    ['libelle'  => 'JS',  'description'  => 'JS',  'active' => 1 ]
                    ];
        DB::table('languages')->insert($languages);
    }
}
