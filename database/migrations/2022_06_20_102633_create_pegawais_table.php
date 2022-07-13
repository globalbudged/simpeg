<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            // $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nik')->unique()->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabkot')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kodepos')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->date('tmt')->nullable();
            $table->string('contact')->nullable();
            $table->string('jenis_kepegawaian_id')->nullable();
            $table->string('pendidikan_id')->nullable();
            $table->string('kategori_id')->nullable();
            $table->string('jurusan_id')->nullable();
            $table->string('jabatan_id')->nullable();
            $table->string('golongan_id')->nullable();
            $table->string('ruangan_id')->nullable();
            $table->string('bagian_id')->nullable();
            $table->smallInteger('flag')->default(1)->comment('0:tidak aktif, 1:Aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
