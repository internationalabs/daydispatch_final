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
        Schema::create('my_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('Rating');
            $table->tinyInteger('Timeliness')->default(0);
            $table->tinyInteger('Communication')->default(0);
            $table->tinyInteger('Documentation')->default(0);
            $table->text('Rating_Comments')->nullable();
            $table->text('Rating_Replied')->nullable();
            $table->bigInteger('CMP_ID')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('all_user_listings')->onDelete('cascade');
            $table->foreign('CMP_ID')->references('id')->on('authorized_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_ratings');
    }
};
