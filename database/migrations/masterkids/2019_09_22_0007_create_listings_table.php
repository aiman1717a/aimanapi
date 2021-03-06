<?php

use App\Employees;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('listings', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('category_id')->unsigned();
            $table->string('name', 100)->nullable(false);
            $table->decimal('price')->nullable(false);
            $table->string('description', 200)->nullable(true);
            $table->string('image', 200)->nullable(false);
            $table->enum('status', ["Active", "InActive"])->nullable(false)->default('InActive');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::connection('masterkids_db')->table('listings', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('masterkids_db')->dropIfExists('listings');
    }
}
