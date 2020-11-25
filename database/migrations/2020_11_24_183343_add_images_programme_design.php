<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesProgrammeDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('programme_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string("image");
            $table->integer("programme_id")->unsigned();
            $table->foreign('programme_id')->references('id')->on('programm_designs')->onDelete('cascade');
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
      Schema::dropIfExists('programm_design_calendar');
    }
}
