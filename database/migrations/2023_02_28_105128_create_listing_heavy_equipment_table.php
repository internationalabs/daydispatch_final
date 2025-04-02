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
    public function up(): void
    {
        Schema::create('listing_heavy_equipment', static function (Blueprint $table) {
            $table->id();
            $table->string('Equipment_Year');
            $table->string('Equipment_Make');
            $table->string('Equipment_Model');
            $table->string('Equipment_Condition');
            $table->string('Trailer_Type');
            $table->bigInteger('Equip_Length')->unsigned();
            $table->bigInteger('Equip_Width')->unsigned();
            $table->bigInteger('Equip_Height')->unsigned();
            $table->bigInteger('Equip_Weight')->unsigned();
            $table->string('Shipment_Preferences');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('all_user_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_heavy_equipment');
    }
};
