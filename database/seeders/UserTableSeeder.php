<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=> 'admin',
                'email' => 'admin@larablog.com',
                'password' => 'password'
            ],
            [
                'name'=> 'user',
                'email' => 'user@larablog.com',
                'password' => 'password'
            ]
        ];

        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'created_at' => now(),
                'updated_at' => now(),

            ]);
        }
    }
}
