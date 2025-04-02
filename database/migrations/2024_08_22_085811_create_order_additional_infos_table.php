<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAdditionalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_additional_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('Additional_Terms')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('Special_Instructions')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('Notes_Customer')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('Contract')->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('Vehcile_Desc')->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Foreign key constraints can be added here if necessary
            // $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_additional_infos');
    }
}
