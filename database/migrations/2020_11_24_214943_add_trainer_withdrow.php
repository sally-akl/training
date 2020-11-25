<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainerWithdrow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('withdrow_record', function (Blueprint $table) {
            $table->increments('id');
            $table->string('withdrw_num');
            $table->float('withdrw_amount');
            $table->integer('is_execute')->default(0);
            $table->timestamp("execute_date")->nullable();
            $table->bigInteger("trainer_id")->unsigned()->nullable();
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('set null');
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
      Schema::dropIfExists('withdrow_record');
    }
}
