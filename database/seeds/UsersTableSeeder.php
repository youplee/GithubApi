<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =   ['nom'=>'admin',
                    'prenom'=>'admin',
                    'username'=>'admin',
                    'email'=>'zouhir@nextmedia.ma',
                    'password'=>bcrypt('123456')
                    ];
        DB::table('users')->insert($users);
    }
}
