<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('benefits')->insert([
            'benefit_uuid' => Str::uuid(),
            'benefit_judul' => 'Accismus Community',
            'benefit_text' => 'RF Online Private Server',
            'benefit_foto' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
