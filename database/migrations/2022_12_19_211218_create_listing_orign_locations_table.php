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
        Schema::create('listing_orign_locations', function (Blueprint $table) {
            $table->id();
            $table->string('Orign_Location')->nullable();
            $table->string('User_Name')->nullable();
            $table->string('User_Email')->nullable();
            $table->string('Local_Phone')->nullable();
            $table->string('Location')->nullable();
            $table->string('Auction_Method')->nullable();
            $table->string('Auction_Phone')->nullable();
            $table->string('Stock_Number')->nullable();
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
        Schema::dropIfExists('listing_orign_locations');
    }
};
