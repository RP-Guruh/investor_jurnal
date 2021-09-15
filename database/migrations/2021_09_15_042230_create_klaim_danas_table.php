<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlaimDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klaim_danas', function (Blueprint $table) {
            $table->id();
            $table->string('id_klaim');
            $table->string('id_anggota');
            $table->date('tanggal_klaim');
            $table->string('nominal');
            $table->string('keterangan');
            $table->string('status');
            
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
        Schema::dropIfExists('klaim_danas');
    }
}
