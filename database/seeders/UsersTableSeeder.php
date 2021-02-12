<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'guest1', 'password' => bcrypt('guest1')],
            ['name' => 'guest2', 'password' => bcrypt('guest2')],
            ['name' => 'guest3', 'password' => bcrypt('guest3')],
        ]);        
    }
}
