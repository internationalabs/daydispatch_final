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
        Schema::create('heavy_truck_spaces', function (Blueprint $table) {
            $table->id();
            $table->string('Truck_Country');
            $table->string('Equipment_condition');
            $table->string('trailer_type');
            $table->string('trailer_specification');
            $table->string('shipment_preferences');
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
        Schema::dropIfExists('heavy_truck_spaces');
    }
};
