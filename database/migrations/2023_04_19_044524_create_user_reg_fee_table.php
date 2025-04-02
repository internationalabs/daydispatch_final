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
        Schema::create('user_reg_fee', function (Blueprint $table) {
            $table->id();
            $table->string('Payment_Type', 50)->default('Reg_Fee');
            $table->string('Payment_ID');
            $table->tinyInteger('status')->default(0);
            $table->decimal('Payment', 6, 2);
            $table->tinyInteger('Method')->default(0);
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
        Schema::dropIfExists('user_reg_fee');
    }
};
