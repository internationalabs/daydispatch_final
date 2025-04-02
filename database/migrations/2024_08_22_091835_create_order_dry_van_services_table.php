<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDryVanServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dry_van_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Pickup_Service', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Delivery_Service', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('order_dry_van_services');
    }
}
