<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDryVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dry_vans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('Freight_Class')->unsigned()->nullable();
            $table->double('Freight_Weight')->unsigned()->nullable();
            $table->tinyInteger('is_hazmat_Check')->default(0);
            $table->string('Shipment_Preferences', 150)->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('Trailer_Specification_Dry', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Trailer_Type_Dry', 255)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('order_dry_vans');
    }
}
