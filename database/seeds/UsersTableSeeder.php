<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 1,
            'valid' => 1,
            'confirmed' => 1,
            'created_at' => '2018-07-18 09:45:24',
            'updated_at' => '2018-07-18 09:45:24',
        ]);
    }
}
