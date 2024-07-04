<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informasis')->insert([
            'informasi_uuid' => Str::uuid(),
            'informasi_judul' => 'Accismus Community',
            'informasi_subjudul' => 'RF Online Private Server',
            'informasi_rf' => 'Sedang Berada Di RF Universe',
            'informasi_instagram' => 'accismus',
            'informasi_discord' => 'accismus',
            'informasi_wa' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
