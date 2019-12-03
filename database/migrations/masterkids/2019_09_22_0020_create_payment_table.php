<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->enum('method', ["Cash", "Card"])->nullable(false);
            $table->dateTime('date')->nullable(false);
            $table->decimal('amount')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('masterkids_db')->table('payment', function(Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::connection('masterkids_db')->table('payment', function(Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
