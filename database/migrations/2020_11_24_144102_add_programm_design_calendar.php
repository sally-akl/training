<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgrammDesignCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('programm_design_calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp("start")->nullable();
            $table->timestamp("end")->nullable();
            $table->integer("booking_id")->unsigned();
            $table->foreign('booking_id')->references('id')->on('transactions')->onDelete('cascade');
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
