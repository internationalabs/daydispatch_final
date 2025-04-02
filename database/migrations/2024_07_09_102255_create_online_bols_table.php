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
        Schema::create('online_bols', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('user_id');
            $table->string('key');
            $table->string('no_odometer');
            $table->string('no_inspection_note');
            $table->string('remote');
            $table->string('headrests');
            $table->string('drivable');
            $table->string('windscreen');
            $table->string('glass_all_intact');
            $table->string('title');
            $table->string('cargo_cover');
            $table->string('spare_tire');
            $table->string('radio');
            $table->string('manual');
            $table->string('navigation_disk');
            $table->string('plugin_charger_cable');
            $table->string('headphone');
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
        Schema::dropIfExists('online_bols');
    }
};
