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
        Schema::create('pickup_online_bols', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('user_id');
            $table->string('deliver_key');
            $table->string('deliver_no_odometer');
            $table->string('deliver_no_inspection_note');
            $table->string('deliver_remote');
            $table->string('deliver_headrests');
            $table->string('deliver_drivable');
            $table->string('deliver_windscreen');
            $table->string('deliver_glass_all_intact');
            $table->string('deliver_title');
            $table->string('deliver_cargo_cover');
            $table->string('deliver_spare_tire');
            $table->string('deliver_radio');
            $table->string('deliver_manual');
            $table->string('deliver_navigation_disk');
            $table->string('deliver_plugin_charger_cable');
            $table->string('deliver_headphone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickup_online_bols');
    }
};
