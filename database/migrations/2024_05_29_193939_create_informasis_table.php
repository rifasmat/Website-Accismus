<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasis', function (Blueprint $table) {
            $table->id('informasi_id');
            $table->uuid('informasi_uuid')->unique();
            $table->string('informasi_judul');
            $table->string('informasi_subjudul');
            $table->string('informasi_rf');
            $table->string('informasi_instagram');
            $table->string('informasi_discord');
            $table->string('informasi_wa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasis');
    }
}
