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
        Schema::create('truck_spaces_dry', function (Blueprint $table) {
            $table->id();
            $table->string('Truck_Country_Dry');
            $table->string('Equipment_Condition_Dry');
            $table->string('Trailer_Type_Dry');
            $table->string('Truck_Departs_Dry');
            $table->string('Trailer_Specification_Dry');
            $table->string('Shipment_Preferences_Dry');
            $table->string('Truck_Location_Dry');
            $table->string('Truck_Heading_Dry');
            $table->string('Truck_Destination_Dry');
            $table->string('is_hazmat_Check');
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
        Schema::dropIfExists('truck_spaces_dry');
    }
};
