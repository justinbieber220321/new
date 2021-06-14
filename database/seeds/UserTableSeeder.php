<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->truncate();
        $data = [
            ['id' => 1, 'username' => 'CROWN', 'email' => 'user@gmail.com', 'parent_id' => '', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],

            ['id' => 2, 'username' => 'CROWN RPS2', 'email' => 'support+rps2@gmail.com', 'parent_id' => '1', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 3, 'username' => 'CROWN RPS3', 'email' => 'support+rps3@gmail.com', 'parent_id' => '1', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],

            ['id' => 4, 'username' => 'CROWN RPS4', 'email' => 'support+rps4@gmail.com', 'parent_id' => '2', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 5, 'username' => 'CROWN RPS5', 'email' => 'support+rps5@gmail.com', 'parent_id' => '2', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 6, 'username' => 'CROWN RPS6', 'email' => 'support+rps6@gmail.com', 'parent_id' => '2', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],

            ['id' => 7, 'username' => 'CROWN RPS7', 'email' => 'support+rps7@gmail.com', 'parent_id' => '3', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 8, 'username' => 'CROWN RPS8', 'email' => 'support+rps8@gmail.com', 'parent_id' => '3', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 9, 'username' => 'CROWN RPS9', 'email' => 'support+rps9@gmail.com', 'parent_id' => '3', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],

            ['id' => 10, 'username' => 'CROWN RPS10', 'email' => 'support+rps10@gmail.com', 'parent_id' => '4', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 11, 'username' => 'CROWN RPS11', 'email' => 'support+rps11@gmail.com', 'parent_id' => '4', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 12, 'username' => 'CROWN RPS12', 'email' => 'support+rps12@gmail.com', 'parent_id' => '7', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 13, 'username' => 'CROWN RPS13', 'email' => 'support+rps13@gmail.com', 'parent_id' => '9', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 14, 'username' => 'CROWN RPS14', 'email' => 'support+rps14@gmail.com', 'parent_id' => '10', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 15, 'username' => 'CROWN RPS15', 'email' => 'support+rps15@gmail.com', 'parent_id' => '10', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 16, 'username' => 'CROWN RPS16', 'email' => 'support+rps16@gmail.com', 'parent_id' => '12', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],

            ['id' => 17, 'username' => 'CROWN RPS17', 'email' => 'support+rps17@gmail.com', 'parent_id' => '16', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 18, 'username' => 'CROWN RPS18', 'email' => 'support+rps18@gmail.com', 'parent_id' => '16', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 19, 'username' => 'CROWN RPS19', 'email' => 'support+rps19@gmail.com', 'parent_id' => '16', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],

            ['id' => 20, 'username' => 'CROWN RPS20', 'email' => 'support+rps20@gmail.com', 'parent_id' => '14', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
            ['id' => 21, 'username' => 'CROWN RPS21', 'email' => 'support+rps21@gmail.com', 'parent_id' => '15', 'status' => getConfig('user.status.active'), 'password' => bcrypt('123456')],
        ];
        DB::table('user')->insert($data);
    }
}