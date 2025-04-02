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
        Schema::create('user_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('Insurance_Certificate')->nullable();
            $table->tinyInteger('Insurance_Privacy')->default(0);
            $table->string('W_Nine')->nullable();
            $table->tinyInteger('W_Nine_Privacy')->default(0);
            $table->string('USDOT_Certificate')->nullable();
            $table->tinyInteger('USDOT_Privacy')->default(0);
            $table->string('Business_License')->nullable();
            $table->tinyInteger('BSNL_Privacy')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('user_certificates');
    }
};
