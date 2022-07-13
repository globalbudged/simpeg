<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_kerjas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('jadwal')->nullable();
            $table->smallInteger('flag')->default(1)->comment('0:tetap, 1:bisa dihapus');
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
        Schema::dropIfExists('jadwal_kerjas');
    }
}
