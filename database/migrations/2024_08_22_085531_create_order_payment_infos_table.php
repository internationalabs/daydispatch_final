<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Order_Booking_Price')->default(0);
            $table->unsignedBigInteger('Deposite_Amount')->default(0);
            $table->string('Payment_Method_Mode', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('Price_Pay_Carrier')->default(0);
            $table->unsignedBigInteger('COD_Amount')->default(0);
            $table->unsignedBigInteger('Balance_Amount')->default(0);
            $table->string('COD_Method_Mode', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Bal_Method_Mode', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('COD_Location_Amount', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('BAL_Payment_Time', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('BAL_Payment_Terms', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('Payment_Desc', 255)->collation('utf8mb4_unicode_ci')->nullable();
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
        Schema::dropIfExists('order_payment_infos');
    }
}
