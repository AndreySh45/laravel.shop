<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
            'id' => 1,
            'name' => 'User1',
            'email' => 'user1@mail.com',
            'password' => Hash::make('user1@mail.com'),
            ],
            [
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin@mail.com'),
            ],
            [
            'id' => 3,
            'name' => 'User3',
            'email' => 'user3@mail.com',
            'password' => Hash::make('user3@mail.com'),
            ]

        ]);
    }
}
