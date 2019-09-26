<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('flat_id');
            $table->unsignedBigInteger('building_id');
            $table->date('begining_of_first_rent');
            $table->date('begining_of_current_rent');
            $table->unsignedBigInteger('contract_id');
            $table->date('end_of_current_rent')->nullable();
            $table->integer('number_of_residents');
            $table->integer('rental');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('residents');
    }
}
