<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_additional_infos', function (Blueprint $table) {
            $table->id();

            $table->text('Additional_Terms')->nullable();
            $table->text('Special_Instructions')->nullable();
            $table->text('Notes_Customer')->nullable();
            $table->text('Contract')->nullable();
            $table->text('Vehcile_Desc')->nullable();
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
        Schema::dropIfExists('listing_additional_infos');
    }
};
