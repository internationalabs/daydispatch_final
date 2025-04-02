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
        Schema::create('listing_payment_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Order_Booking_Price')->unsigned()->default(0);
            $table->bigInteger('Deposite_Amount')->unsigned()->default(0);
            $table->string('Payment_Method_Mode')->nullable();
            $table->bigInteger('Price_Pay_Carrier')->unsigned()->default(0);
            $table->bigInteger('COD_Amount')->unsigned()->default(0);
            $table->bigInteger('Balance_Amount')->unsigned()->default(0);
            $table->string('COD_Method_Mode')->nullable();
            $table->string('Bal_Method_Mode')->nullable();
            $table->string('COD_Location_Amount')->nullable();
            $table->string('BAL_Payment_Time')->nullable();
            $table->string('BAL_Payment_Terms')->nullable();
            $table->string('Payment_Desc')->nullable();
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
        Schema::dropIfExists('listing_payment_infos');
    }
};
