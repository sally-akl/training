<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChatMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');
            $table->text("msg");
            $table->bigInteger("from_user")->unsigned()->nullable();
            $table->foreign('from_user')->references('id')->on('users')->onDelete('set null');
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
      Schema::dropIfExists('chat');
    }
}
