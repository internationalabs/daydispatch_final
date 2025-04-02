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
        Schema::create('agent_revenues', function (Blueprint $table) {
            $table->id();
            $table->double('Agent_Reward');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('agent_id')->unsigned();
            $table->timestamps();
            $table->foreign('agent_id')->references('id')->on('authorized_agents')->onDelete('cascade');
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
        Schema::dropIfExists('agent_revenues');
    }
};
