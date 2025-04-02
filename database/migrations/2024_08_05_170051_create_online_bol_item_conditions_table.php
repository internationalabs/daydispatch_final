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
        Schema::create('online_bol_item_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('onlinebol_id'); // Foreign key to OnlineBol
            $table->string('item_name'); // Loose item name
            $table->string('condition'); // Condition of the item
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('onlinebol_id')->references('id')->on('online_bols')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_bol_item_conditions');
    }
};
