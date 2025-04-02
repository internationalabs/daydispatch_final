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
        Schema::create('listing_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('Agreement_Name');
            $table->string('Agreement_Signature');
            $table->tinyInteger('Sign');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('CMP_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('CMP_id')->references('id')->on('authorized_users')->onDelete('cascade');
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
        Schema::dropIfExists('listing_agreements');
    }
};
