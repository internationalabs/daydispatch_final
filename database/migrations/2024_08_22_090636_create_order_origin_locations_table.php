<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOriginLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_origin_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Orign_Location', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('User_Name', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('User_Email', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Local_Phone', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Location', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Auction_Method', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Auction_Phone', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Stock_Number', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('Business_Location', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Business_Phone', 255)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('order_origin_locations');
    }
}
