<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBroadcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id('broadcast_id');
            $table->uuid('broadcast_uuid')->unique();
            $table->string('broadcast_sentby');
            $table->string('broadcast_pengirim_email');
            $table->string('broadcast_subject');
            $table->string('broadcast_penerima');
            $table->text('broadcast_pesan');
            $table->string('broadcast_tanggal');
            $table->string('broadcast_status');
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
        Schema::dropIfExists('broadcasts');
    }
}
