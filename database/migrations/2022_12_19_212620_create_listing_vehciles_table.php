<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_vehciles', function (Blueprint $table) {
            $table->id();
            $table->string('Reg_By');
            $table->string('Vin_Number')->nullable();
            $table->string('Vehcile_Year');
            $table->string('Vehcile_Make');
            $table->string('Vehcile_Model');
            $table->string('Vehcile_Color')->nullable();
            $table->string('Vehcile_Type');
            $table->string('Vehcile_Condition');
            $table->string('Trailer_Type');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('all_user_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_vehciles');
    }
};
