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
        Schema::create('add_disputes', function (Blueprint $table) {
            $table->id();
            $table->string('Dispute_Comments');
            $table->bigInteger('Profile_ID')->unsigned();
            $table->bigInteger('rate_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('rate_id')->references('id')->on('my_ratings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_disputes');
    }
};
