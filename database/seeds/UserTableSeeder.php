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
            ['id' => 1, 'user_id' => 1, 'username' => 'CROWN 1', 'email' => 'user1@gmail.com', 'parent_id' => '', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 2, 'user_id' => 2, 'username' => 'CROWN 2', 'email' => 'user2@gmail.com', 'parent_id' => '1', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 3, 'user_id' => 3, 'username' => 'CROWN 3', 'email' => 'user3@gmail.com', 'parent_id' => '1', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 4, 'user_id' => 4, 'username' => 'CROWN 4', 'email' => 'user4@gmail.com', 'parent_id' => '2', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 5, 'user_id' => 5, 'username' => 'CROWN 5', 'email' => 'user5@gmail.com', 'parent_id' => '2', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 6, 'user_id' => 6, 'username' => 'CROWN 6', 'email' => 'user6@gmail.com', 'parent_id' => '2', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 7, 'user_id' => 7, 'username' => 'CROWN 7', 'email' => 'user7@gmail.com', 'parent_id' => '3', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 8, 'user_id' => 8, 'username' => 'CROWN 8', 'email' => 'user8@gmail.com', 'parent_id' => '3', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 9, 'user_id' => 9, 'username' => 'CROWN 9', 'email' => 'user9@gmail.com', 'parent_id' => '3', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 10, 'user_id' => 10, 'username' => 'CROWN 10', 'email' => 'user10@gmail.com', 'parent_id' => '4', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 11, 'user_id' => 11, 'username' => 'CROWN 11', 'email' => 'user11@gmail.com', 'parent_id' => '4', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 12, 'user_id' => 12, 'username' => 'CROWN 12', 'email' => 'user12@gmail.com', 'parent_id' => '7', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 13, 'user_id' => 13, 'username' => 'CROWN 13', 'email' => 'user13@gmail.com', 'parent_id' => '9', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 14, 'user_id' => 14, 'username' => 'CROWN 14', 'email' => 'user14@gmail.com', 'parent_id' => '10', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 15, 'user_id' => 15, 'username' => 'CROWN 15', 'email' => 'user15@gmail.com', 'parent_id' => '10', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 16, 'user_id' => 16, 'username' => 'CROWN 16', 'email' => 'user16@gmail.com', 'parent_id' => '12', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 17, 'user_id' => 17, 'username' => 'CROWN 17', 'email' => 'user17@gmail.com', 'parent_id' => '16', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 18, 'user_id' => 18, 'username' => 'CROWN 18', 'email' => 'user18@gmail.com', 'parent_id' => '16', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 19, 'user_id' => 19, 'username' => 'CROWN 19', 'email' => 'user19@gmail.com', 'parent_id' => '16', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 20, 'user_id' => 20, 'username' => 'CROWN 20', 'email' => 'user20@gmail.com', 'parent_id' => '14', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 21, 'user_id' => 21, 'username' => 'CROWN 21', 'email' => 'user21@gmail.com', 'parent_id' => '15', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 22, 'user_id' => 22, 'username' => 'CROWN 22', 'email' => 'user22@gmail.com', 'parent_id' => '20', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 23, 'user_id' => 23, 'username' => 'CROWN 23', 'email' => 'user23@gmail.com', 'parent_id' => '20', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 24, 'user_id' => 24, 'username' => 'CROWN 24', 'email' => 'user24@gmail.com', 'parent_id' => '20', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 25, 'user_id' => 25, 'username' => 'CROWN 25', 'email' => 'user25@gmail.com', 'parent_id' => '18', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 26, 'user_id' => 26, 'username' => 'CROWN 26', 'email' => 'user26@gmail.com', 'parent_id' => '18', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 27, 'user_id' => 27, 'username' => 'CROWN 27', 'email' => 'user27@gmail.com', 'parent_id' => '19', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 28, 'user_id' => 28, 'username' => 'CROWN 28', 'email' => 'user28@gmail.com', 'parent_id' => '19', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 29, 'user_id' => 29, 'username' => 'CROWN 29', 'email' => 'user29@gmail.com', 'parent_id' => '19', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 30, 'user_id' => 30, 'username' => 'CROWN 30', 'email' => 'user30@gmail.com', 'parent_id' => '22', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 31, 'user_id' => 31, 'username' => 'CROWN 31', 'email' => 'user31@gmail.com', 'parent_id' => '22', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 32, 'user_id' => 32, 'username' => 'CROWN 32', 'email' => 'user32@gmail.com', 'parent_id' => '24', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 33, 'user_id' => 33, 'username' => 'CROWN 33', 'email' => 'user33@gmail.com', 'parent_id' => '24', 'status' => statusOn(), 'password' => bcrypt('123456')],

            ['id' => 34, 'user_id' => 34, 'username' => 'CROWN 34', 'email' => 'user34@gmail.com', 'parent_id' => '26', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 35, 'user_id' => 35, 'username' => 'CROWN 35', 'email' => 'user35@gmail.com', 'parent_id' => '26', 'status' => statusOn(), 'password' => bcrypt('123456')],
            ['id' => 36, 'user_id' => 36, 'username' => 'CROWN 36', 'email' => 'user36@gmail.com', 'parent_id' => '26', 'status' => statusOn(), 'password' => bcrypt('123456')],
        ];
        DB::table('user')->insert($data);
    }
}