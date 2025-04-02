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
        Schema::create('listing_dry_vans', static function (Blueprint $table) {
            $table->id();
            $table->double('Freight_Class')->unsigned()->nullable();
            $table->double('Freight_Weight')->unsigned()->nullable();
            $table->tinyInteger('is_hazmat_Check')->default(0);
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
        Schema::dropIfExists('listing_dry_vans');
    }
};
