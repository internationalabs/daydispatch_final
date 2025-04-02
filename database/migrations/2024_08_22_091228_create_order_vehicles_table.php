<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Reg_By', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Vin_Number', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Vehcile_Year', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Vehcile_Make', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Vehcile_Model', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Vehcile_Color', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Vehcile_Type', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Vehcile_Condition', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Trailer_Type', 255)->collation('utf8mb4_unicode_ci');
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
        Schema::dropIfExists('order_vehicles');
    }
}
