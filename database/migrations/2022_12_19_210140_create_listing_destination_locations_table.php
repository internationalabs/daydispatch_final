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
        Schema::create('listing_destination_locations', function (Blueprint $table) {
            $table->id();
            $table->string('Destination_Location')->nullable();
            $table->string('Dest_User_Name')->nullable();
            $table->string('Dest_User_Email')->nullable();
            $table->string('Dest_Local_Phone')->nullable();
            $table->string('Dest_Location')->nullable();
            $table->string('Dest_Auction_Method')->nullable();
            $table->string('Dest_Auction_Phone')->nullable();
            $table->string('Dest_Stock_Number')->nullable();
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
        Schema::dropIfExists('listing_destination_locations');
    }
};
