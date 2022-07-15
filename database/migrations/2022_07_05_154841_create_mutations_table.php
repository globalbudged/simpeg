<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('kode_mutasi')->nullable();
            $table->string('no_mutasi')->unique()->nullable();
            $table->string('no_surat')->nullable();
            $table->string('dasar_phk')->nullable();
            $table->string('dasar')->nullable();
            $table->string('kepada')->nullable();
            $table->string('untuk')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->date('tgl_mutasi')->nullable();
            $table->date('tgl_phk')->nullable();
            $table->unsignedBigInteger('jenis_kepegawaian_id')->nullable();
            $table->unsignedBigInteger('jenis_phk_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->smallInteger('flag')->default(1)->comment('0 : belum valid, 1 : valid');
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
        Schema::dropIfExists('mutations');
    }
}
