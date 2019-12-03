<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('categories', function (Blueprint $table) {
            $table->BigIncrements('id')->autoIncrement();
            $table->string('code', 50)->nullable(false);
            $table->string('slug', 100)->nullable(false);
            $table->string('name', 100)->nullable(false);
            $table->string('description', 200)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('masterkids_db')->dropIfExists('categories');
    }
}
