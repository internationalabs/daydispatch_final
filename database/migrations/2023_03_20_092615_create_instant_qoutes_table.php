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
        Schema::create('instant_qoutes', function (Blueprint $table) {
            $table->id();
            $table->string('From_ZipCode');
            $table->string('To_ZipCode');
            $table->string('Select_Vehicle');
            $table->string('Car_Make')->nullable();
            $table->string('Car_Model')->nullable();
            $table->string('Year_Make_Model')->nullable();
            $table->text('Additional_Instruction')->nullable();
            $table->bigInteger('Vehicle_Length')->unsigned()->nullable();
            $table->bigInteger('Vehicle_Width')->unsigned()->nullable();
            $table->bigInteger('Vehicle_Height')->unsigned()->nullable();
            $table->bigInteger('Vehicle_Weight')->unsigned()->nullable();
            $table->string('Carrier_Type');
            $table->string('Carrier_Condition');
            $table->string('Custo_Name');
            $table->string('Custo_Email');
            $table->string('Custo_Phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instant_qoutes');
    }
};
