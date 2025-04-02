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
        Schema::create('order_forms', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('first_phone');
            $table->string('second_phone');
            $table->string('address');
            $table->string('zip_code');
            $table->string('email_address');
            $table->string('carrier_type');
            $table->string('vehicle_name');
            $table->string('vehicle_runs');
            $table->string('auction');
            $table->string('auction_name');
            $table->string('stock_number');
            $table->string('last_of_vin');
            $table->integer('key');
            $table->string('vehicle_first_available_date');
            $table->string('origin_contact_name');
            $table->string('origin_email');
            $table->string('origin_first_phone');
            $table->string('origin_second_phone');
            $table->string('origin_address');
            $table->string('origin_city_zip_state');
            $table->string('destination_contact_name');
            $table->string('destination_email');
            $table->string('destination_first_phone');
            $table->string('destination_second_phone');
            $table->string('destination_address');
            $table->string('destination_city_zip_state');
            $table->longText('additional_vehicle_information')->nullable();
            $table->string('terms_condition');
            $table->string('your_name');
            $table->string('your_signature');
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
        Schema::dropIfExists('order_forms');
    }
};
