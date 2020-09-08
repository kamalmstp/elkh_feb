<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTambahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tambahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skp_id')->unsigned();
            $table->integer('jangka_id')->unsigned();
            $table->string('tugas');
            $table->timestamps();

            $table->foreign('skp_id')->references('id')->on('skp')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jangka_id')->references('id')->on('jangka')
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
        Schema::dropIfExists('tambahan');
    }
}
