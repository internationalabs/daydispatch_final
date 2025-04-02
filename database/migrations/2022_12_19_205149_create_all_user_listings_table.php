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
        Schema::create('all_user_listings', static function (Blueprint $table) {
            $table->id();
            $table->string('Listing_Status');
            $table->string('Ref_ID');
            $table->tinyInteger('Custom_Listing')->default(0);
            $table->date('Posted_Date')->nullable();
            $table->tinyInteger('Listing_Type')->default(0);
            $table->tinyInteger('Is_Rate')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamp('expire_at')->nullable()->default(null);
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
        Schema::dropIfExists('all_user_listings');
    }
};
