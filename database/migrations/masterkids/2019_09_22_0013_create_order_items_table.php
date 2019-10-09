<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('listing_id')->unsigned();
            $table->decimal('price')->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->integer('total')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('masterkids_db')->table('order_items', function(Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('listing_id')->references('id')->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('masterkids_db')->dropIfExists('order_items');
    }
}
