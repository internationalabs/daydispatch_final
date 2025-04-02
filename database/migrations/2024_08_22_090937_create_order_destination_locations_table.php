<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDestinationLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_destination_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Destination_Location', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_User_Name', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_User_Email', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_Local_Phone', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_Location', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_Auction_Method', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_Auction_Phone', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_Stock_Number', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('Dest_Business_Location', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_Business_Phone', 255)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('order_destination_locations');
    }
}
