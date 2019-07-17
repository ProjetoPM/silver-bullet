<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
//            'password'       => '$2y$10$E/QkIlK8ZKxzauvoUut/ouo/HLysR/skkcivAaYzTHReekcIpkkbW',
            'password' => Hash::make('102030'),
            'remember_token' => null,
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
