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
        Schema::create('miscellenous_items', function (Blueprint $table) {
            $table->id();
            $table->string('Item_Name');
            $table->string('Other')->nullable();
            $table->bigInteger('Item_Price')->unsigned();
            $table->foreignId('user_id')->references('id')->on('authorized_users');
            $table->foreignId('order_id')->references('id')->on('all_user_listings');
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
        Schema::dropIfExists('miscellenous_items');
    }
};
