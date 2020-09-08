<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTarget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skp_id')->unsigned();
            $table->integer('skp_kegiatan_id')->unsigned();
            $table->integer('jangka_id')->unsigned();
            $table->float('ak', 6, 2)->nullable();
            $table->float('kuantitas', 6, 2)->nullable();
            $table->integer('output_id')->unsigned()->nullable();
            $table->float('mutu', 6, 2)->nullable();
            $table->float('waktu', 6, 2)->nullable();
            $table->integer('waktu_id')->unsigned()->nullable();
            $table->float('biaya', 6, 2)->nullable();
            $table->float('r_ak', 6, 2)->nullable();
            $table->float('r_kuantitas', 6, 2)->nullable();            
            $table->float('r_mutu', 6, 2)->nullable();
            $table->float('r_waktu', 6, 2)->nullable();
            $table->float('r_biaya', 6, 2)->nullable();
            $table->float('perhitungan', 6, 2)->nullable();
            $table->float('capaian', 6, 2)->nullable();
            $table->timestamps();

            $table->foreign('skp_id')->references('id')->on('skp')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('skp_kegiatan_id')->references('id')->on('skp_kegiatan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jangka_id')->references('id')->on('jangka')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('output_id')->references('id')->on('satuan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('waktu_id')->references('id')->on('satuan')
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
        Schema::dropIfExists('target');
    }
}
