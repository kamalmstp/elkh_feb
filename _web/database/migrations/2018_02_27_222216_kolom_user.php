<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KolomUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('pangkat_id')->after('atasan_id')
                    ->unsigned()->nullable();
            $table->integer('bagian_id')->after('nip')
                    ->unsigned()->nullable();
            
            $table->foreign('pangkat_id')->references('id')->on('pangkat')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bagian_id')->references('id')->on('bagian')
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
        Schema::table('users', function (Blueprint $table) {            
            $table->dropForeign('users_pangkat_id_foreign');
            $table->dropForeign('users_bagian_id_foreign');
            $table->dropColumn('pangkat_id');
            $table->dropColumn('bagian_id');
        });
    }
}
