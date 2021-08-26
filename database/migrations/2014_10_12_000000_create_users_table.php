<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_anggota');
            $table->string('name');
            $table->string('no_wa')->default('belum isi');
            $table->string('pekerjaan')->default('belum isi');
            $table->string('instansi')->default('belum isi');
            $table->string('nominal_investasi');

            $table->date('tanggal_bergabung');
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('belum lengkap');

            $table->integer('active');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
