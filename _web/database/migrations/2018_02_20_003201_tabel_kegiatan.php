<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_lkh', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lkh_id')->unsigned();
            $table->string('kegiatan');
            $table->string('waktua');
            $table->string('waktub');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('lkh_id')->references('id')->on('lkh')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_lkh');
    }
}
