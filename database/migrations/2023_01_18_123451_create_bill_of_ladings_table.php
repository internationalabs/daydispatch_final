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
        Schema::create('bill_of_ladings', function (Blueprint $table) {
            $table->id();
            $table->string('Meter_Reading');
            $table->string('Pickup_Location');
            $table->string('Pickup_Person');
            $table->string('Phone_Number');
            $table->string('BOL_Name');
            $table->string('BOL_Signature');
            $table->tinyInteger('Sign');
            $table->string('Bol_Type');
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
        Schema::dropIfExists('bill_of_ladings');
    }
};
