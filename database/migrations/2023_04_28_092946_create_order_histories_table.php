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
        Schema::create('order_histories', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->bigInteger('cancel_by')->unsigned()->nullable();
            $table->bigInteger('archived_by')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('CMP_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('all_user_listings')->onDelete('cascade');
            $table->foreign('CMP_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('cancel_by')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('archived_by')->references('id')->on('authorized_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_histories');
    }
};
