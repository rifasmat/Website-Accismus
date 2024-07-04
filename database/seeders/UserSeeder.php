<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'administrator',
                'username' => 'administrator',
                'email' => 'administrator@gmail.com',
                'password' => Hash::make('administrator'),
                'wa' => '08123456789',
                'discord' => 'administrator',
                'foto' => 'default.png',
                'role' => 'Administrator',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nama' => 'humas',
                'username' => 'humas',
                'email' => 'Humas@gmail.com',
                'password' => Hash::make('humas'),
                'wa' => '08123456789',
                'discord' => 'Humas',
                'foto' => 'default.png',
                'role' => 'Humas',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nama' => 'moderator',
                'username' => 'moderator',
                'email' => 'moderator@gmail.com',
                'password' => Hash::make('moderator'),
                'wa' => '08123456789',
                'discord' => 'moderator',
                'foto' => 'default.png',
                'role' => 'Moderator',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nama' => 'member',
                'username' => 'member',
                'email' => 'member@gmail.com',
                'password' => Hash::make('member'),
                'wa' => '08123456789',
                'discord' => 'member',
                'foto' => 'default.png',
                'role' => 'Member',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nama' => 'guest',
                'username' => 'guest',
                'email' => 'guest@gmail.com',
                'password' => Hash::make('guest'),
                'wa' => '08123456789',
                'discord' => 'guest',
                'foto' => 'default.png',
                'role' => 'Guest',
                'uuid' => Str::uuid()->toString(),
            ],
        ]);
    }
}
