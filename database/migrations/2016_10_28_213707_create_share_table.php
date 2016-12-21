<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share', function (Blueprint $table) {
            $table->integer('id_file')->unsigned();
            $table->foreign('id_file')->references('id')->on('files');
            $table->integer('userfrom')->unsigned();
            $table->foreign('userfrom')->references('id')->on('users');
            $table->integer('userto')->unsigned();
            $table->foreign('userto')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
