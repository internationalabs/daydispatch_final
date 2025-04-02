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
        Schema::create('three_way_tickets', function (Blueprint $table) {
            $table->id();
            $table->text('Order_Subject');
            $table->string('Order_Reason', 250);
            $table->text('Order_Desc');
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('CMP_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('all_user_listings')->onDelete('cascade');
            $table->foreign('CMP_id')->references('id')->on('authorized_users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('authorized_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('three_way_tickets');
    }
};
