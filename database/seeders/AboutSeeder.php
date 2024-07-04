<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->insert([
            'about_uuid' => Str::uuid(),
            'about_judul' => 'Accismus Community',
            'about_text' => 'RF Online Private Server',
            'about_foto' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
