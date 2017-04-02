<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusLunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunas_bayars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id');
            $table->string('lunas_semester_ganjil');
            $table->string('lunas_semester_genap');            
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
        Schema::drop('lunas_bayars');
    }
}

