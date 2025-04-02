<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPickupDeliverInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pickup_deliver_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('Pickup_Date');
            $table->string('Pickup_Date_mode', 255)->collation('utf8mb4_unicode_ci');
            $table->date('Delivery_Date')->nullable();
            $table->string('Delivery_Date_mode', 255)->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('Pickup_Start_Time', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Pickup_End_Time', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Delivery_Start_Time', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Delivery_End_Time', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->timestamps();

            // Foreign key constraints can be added here if necessary
            // $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_pickup_deliver_infos');
    }
}
