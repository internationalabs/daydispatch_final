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
        Schema::create('request_brokers', function (Blueprint $table) {
            $table->id();
            $table->string('Current_Price');
            $table->string('Offer_Price')->nullable();
            $table->string('Date_Pickup_Mode');
            $table->string('Pickup_Date');
            $table->string('Date_Delivery_Mode');
            $table->string('Delivery_Date');
            $table->string('status')->default('Pending');
            $table->bigInteger('CMP_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('is_cancel')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('CMP_id')->references('id')->on('authorized_users')->onDelete('cascade');
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
        Schema::dropIfExists('request_brokers');
    }
};
