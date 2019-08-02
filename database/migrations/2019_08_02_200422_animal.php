<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Animal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('animal', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('edad');
            $table->bigInteger('tipoanimalid')->unsigned();
            $table->foreign('tipoanimalid')->references('id')->on('tipoanimal')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal');
    }
}
