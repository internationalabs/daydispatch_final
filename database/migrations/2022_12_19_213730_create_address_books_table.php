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
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->string('CMP_Name');
            $table->string('CMP_Contact');
            $table->string('CMP_Address');
            $table->string('Buyer_Number');
            $table->string('CMP_City');
            $table->string('CMP_Postal_Code');
            $table->string('CMP_Phone_Number');
            $table->string('CMP_Phone_Number_I')->nullable();
            $table->string('CMP_Phone_Number_II')->nullable();
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
        Schema::dropIfExists('address_books');
    }
};
