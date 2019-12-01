<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeVarcharValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('attribute_varchar_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attribute_id')->unsigned();
            $table->bigInteger('listing_id')->unsigned();
            $table->string('value', 200);
            $table->timestamps();
        });

        Schema::connection('masterkids_db')->table('attribute_varchar_values', function(Blueprint $table) {
            $table->foreign('attribute_id')->references('id')->on('attributes');
        });

        Schema::connection('masterkids_db')->table('attribute_varchar_values', function(Blueprint $table) {
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
        Schema::connection('masterkids_db')->dropIfExists('attribute_varchar_values');
    }
}
