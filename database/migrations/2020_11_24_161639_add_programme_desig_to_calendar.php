<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgrammeDesigToCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programm_design_calendar', function (Blueprint $table) {
          $table->integer("programme_id")->unsigned();
          $table->foreign('programme_id')->references('id')->on('programm_designs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programm_design_calendar', function (Blueprint $table) {
          $table->dropColumn('programme_id');
        });
    }
}
