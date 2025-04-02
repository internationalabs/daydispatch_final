<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHeavyEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_heavy_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Equipment_Year', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Equipment_Make', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Equipment_Model', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Equipment_Condition', 255)->collation('utf8mb4_unicode_ci');
            $table->string('Trailer_Type', 255)->collation('utf8mb4_unicode_ci');
            $table->decimal('Equip_Length', 10, 0)->unsigned()->default(0);
            $table->decimal('Equip_Width', 10, 0)->unsigned()->default(0);
            $table->decimal('Equip_Height', 10, 0)->unsigned()->default(0);
            $table->decimal('Equip_Weight', 10, 0)->unsigned()->default(0);
            $table->string('Shipment_Preferences', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('Trailer_Specification', 255)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('order_heavy_equipment');
    }
}
