<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->truncate();
        $admin = [
            'username' => 'Admin',
            'email' => 'support+admin@system-rps.com',
            'password' => bcrypt('aA@dmin123'),
            'status' => 1,
        ];
        DB::table('admin')->insert($admin);
    }
}