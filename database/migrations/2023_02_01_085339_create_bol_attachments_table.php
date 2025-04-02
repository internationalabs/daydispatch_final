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
        Schema::create('bol_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('Bill_Lading_Name')->nullable();
            $table->bigInteger('bol_id')->unsigned();
            $table->timestamps();
            $table->foreign('bol_id')->references('id')->on('bill_of_ladings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bol_attachments');
    }
};
