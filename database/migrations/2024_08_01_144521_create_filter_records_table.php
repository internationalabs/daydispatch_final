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
        Schema::create('filter_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('origin_address')->nullable();
            $table->string('destination_address')->nullable();
            $table->integer('posted_hours')->nullable();
            $table->string('shipper_prefer')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_condition')->nullable();
            $table->string('trailer_type')->nullable();
            $table->string('origin_radius')->nullable();
            $table->string('destination_radius')->nullable();
            $table->boolean('comp_active')->nullable();
            $table->string('equipment_type')->nullable();
            $table->string('origin_zip_code')->nullable();
            $table->string('destination_zip_code')->nullable();
            $table->decimal('min_total_pay', 10, 2)->nullable();
            $table->decimal('min_rate_pay', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('min_vehicle')->nullable();
            $table->integer('max_vehicle')->nullable();
            $table->string('shipment_prefrences')->nullable();
            $table->string('trailer_specification')->nullable();
            $table->decimal('min_length', 10, 2)->nullable();
            $table->decimal('max_length', 10, 2)->nullable();
            $table->decimal('min_width', 10, 2)->nullable();
            $table->decimal('max_width', 10, 2)->nullable();
            $table->decimal('min_height', 10, 2)->nullable();
            $table->decimal('max_height', 10, 2)->nullable();
            $table->decimal('min_weight', 10, 2)->nullable();
            $table->decimal('max_weight', 10, 2)->nullable();
            $table->string('freight_equipment_type')->nullable();
            $table->string('freight_shipment_prefrences')->nullable();
            $table->string('freight_trailer_specification')->nullable();
            $table->string('freight_class')->nullable();
            $table->decimal('min_freight_weight', 10, 2)->nullable();
            $table->decimal('max_freight_weight', 10, 2)->nullable();
            $table->string('state')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->decimal('rating', 10, 2)->nullable();
            $table->timestamps();

            // Foreign key constraint for user_id (if required)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_records');
    }
};
