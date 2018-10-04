<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Triskelion\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();
        $user = new User();
        $user->register([
            'name' => 'PureHow',
            'email' => 'purehow@purehow.com',
            'password' => bcrypt('nevel'),
            'active' => 1,
        ]);
    }
}
