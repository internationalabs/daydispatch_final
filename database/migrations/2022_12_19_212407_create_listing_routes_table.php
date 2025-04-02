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
        Schema::create('listing_routes', function (Blueprint $table) {
            $table->id();
            $table->string('Origin_Address')->nullable();
            $table->string('Origin_Address_II')->nullable();
            $table->string('Origin_ZipCode');
            $table->string('Destination_Address')->nullable();
            $table->string('Destination_Address_II')->nullable();
            $table->string('Dest_ZipCode');
            $table->decimal('Miles')->unsigned()->default(0);
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
        Schema::dropIfExists('listing_routes');
    }
};
