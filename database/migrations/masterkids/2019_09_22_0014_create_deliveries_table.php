<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('name')->nullable(false);
            $table->string('street')->nullable(false);
            $table->string('state')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('island')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('masterkids_db')->table('deliveries', function(Blueprint $table) {
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
        Schema::connection('masterkids_db')->dropIfExists('deliveries');
    }
}
