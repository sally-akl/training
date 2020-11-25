<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgrammeDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('programm_designs', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->text("desc");
            $table->string("vedio")->nullable();
            $table->string("media_type");
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
      Schema::dropIfExists('programm_designs');
    }
}
