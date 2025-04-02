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
        Schema::create('user_insurrances', function (Blueprint $table) {
            $table->id();
            $table->date('Expiration_Date')->nullable();
            $table->string('Cargo_Limit')->nullable();
            $table->string('Deductable')->nullable();
            $table->string('Auto_Policy_Number')->nullable();
            $table->string('Cargo_Policy_Number')->nullable();
            $table->string('Agent_Name')->nullable();
            $table->string('Agent_Phone')->nullable();
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
        Schema::dropIfExists('user_insurrances');
    }
};
