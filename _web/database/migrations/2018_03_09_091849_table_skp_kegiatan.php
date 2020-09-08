<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableSkpKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skp_id')->unsigned();
            $table->integer('kegiatan_id')->unsigned();
            $table->timestamps();

            $table->foreign('skp_id')->references('id')->on('skp')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan_skp')
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
        Schema::dropIfExists('skp_kegiatan');
    }
}
