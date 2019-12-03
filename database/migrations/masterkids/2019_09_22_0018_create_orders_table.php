<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->enum('status', ['Pending', 'Complete', 'Cancelled'])->nullable(false);
            $table->dateTime('date')->nullable(false);
            $table->decimal('total')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('masterkids_db')->table('orders', function(Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('masterkids_db')->dropIfExists('orders');
    }
}
