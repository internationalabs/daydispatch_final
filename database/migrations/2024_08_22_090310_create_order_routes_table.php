<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Origin_Address', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Origin_Address_II', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Origin_ZipCode', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Destination_Address', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Destination_Address_II', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Dest_ZipCode', 255)->collation('utf8mb4_unicode_ci');
            $table->decimal('Miles', 8, 2)->unsigned()->default(0.00);
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
        Schema::dropIfExists('order_routes');
    }
}
