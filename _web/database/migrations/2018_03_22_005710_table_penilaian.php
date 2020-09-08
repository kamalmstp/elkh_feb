<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablePenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skp_id')->unsigned();            
            $table->integer('jangka_id')->unsigned();      
            $table->integer('perilaku_id')->unsigned();      
            $table->float('nilai', 5, 2)->nullable();
            $table->integer('kategori_id')->unsigned()->nullable();      
            $table->timestamps();

            $table->foreign('skp_id')->references('id')->on('skp')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jangka_id')->references('id')->on('jangka')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('perilaku_id')->references('id')->on('perilaku')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')
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
        Schema::dropIfExists('penilaian');
    }
}
