<?php

use Illuminate\Database\Seeder;

class RecherchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    {
        $recherches   = [

            ['libelle'  => 'code',   'description'  => 'code',   'active' => 1 ],
            ['libelle'  => 'issues', 'description'  => 'issues', 'active' => 1 ],
            ['libelle'  =>'repositories', 'description'=>'repositories','active' => 1 ],
            ['libelle'  =>'users'       ,'description'  =>'users', 'active' => 1 ]
                        ];
        DB::table('recherches')->insert($recherches);
    }
    }
}
