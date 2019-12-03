<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('masterkids_db')->create('employees', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name', 100)->nullable(false);
            $table->string('password', 100)->nullable(false);
            $table->string('email', 100)->nullable(false)->unique();
            $table->enum('type', ['Admin', 'Editors', 'Moderators'])->nullable(false)->default('Admin');
            $table->enum('status', ["Active", "InActive"])->nullable(false)->default('Active');
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
        Schema::connection('masterkids_db')->dropIfExists('employees');
    }
}
