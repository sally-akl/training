<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("transaction_num");
            $table->bigInteger("user_id")->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger("trainer_id")->unsigned()->nullable();
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger("package_id")->unsigned()->nullable();
            $table->foreign('package_id')->references('id')->on('package')->onDelete('set null');
            $table->timestamp('transfer_date');
            $table->integer("is_payable");
            $table->string("transfer_payment_type");
            $table->string("paymentToken");
            $table->string("paymentId");
            $table->float("amount");
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
      Schema::dropIfExists('transactions');
    }
}
