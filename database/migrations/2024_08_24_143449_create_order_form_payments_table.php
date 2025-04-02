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
        Schema::create('order_form_payments', function (Blueprint $table) {
            $table->id();
            
            // Adding the fields
            $table->decimal('booking_price', 10, 2); // Booking Price
            $table->decimal('deposit', 10, 2); // Deposit
            $table->decimal('balance_amount', 10, 2); // Balance Amount

            $table->string('card_first_name'); // Card First Name
            $table->string('card_last_name'); // Card Last Name
            $table->string('billing_address'); // Billing Address
            $table->string('zip_code'); // ZIP Code
            $table->string('card_type'); // Card Type
            
            $table->string('credit_card_number'); // Credit Card Number
            $table->string('card_expiry_date'); // Card Expiry Date
            $table->string('card_security_code'); // Card Security (CVC)

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
        Schema::dropIfExists('order_form_payments');
    }
};
