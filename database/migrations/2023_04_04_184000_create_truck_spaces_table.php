<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_spaces', function (Blueprint $table) {
            $table->id();
            $table->string('Truck_Country');
            $table->integer('Truck_Space')->unsigned()->default(0);
            $table->string('Truck_Trailer_Type');
            $table->string('Truck_Condition');
            $table->string('Truck_Departs');
            $table->string('Truck_Location');
            $table->string('Truck_Heading');
            $table->string('Truck_Destination');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('truck_spaces');
    }
};
