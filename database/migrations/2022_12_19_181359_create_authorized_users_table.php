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
        Schema::create('authorized_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('usr_type', 50);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('Company_Name');
            $table->string('Company_USDot')->nullable();
            $table->string('Mc_Number')->nullable();
            $table->string('Business_Licence')->nullable();
            $table->string('Company_Country');
            $table->string('Company_State');
            $table->string('Company_City');
            $table->string('Contact_Phone');
            $table->string('Address');
            $table->string('Company_Desc')->nullable();
            $table->string('Local_Phone')->nullable();
            $table->string('Toll_Free')->nullable();
            $table->string('Fax_Phone')->nullable();
            $table->string('Dispatch_Contact')->nullable();
            $table->string('Dispatch_Phone')->nullable();
            $table->string('Contact_Method')->nullable();
            $table->string('Website_Url')->nullable();
            $table->string('Time_Zone')->nullable();
            $table->string('Hours_Operations')->nullable();
            $table->string('ref_code', 50)->nullable();
            $table->tinyInteger('Profile_Update')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('admin_verify')->default(0);
            $table->tinyInteger('admin_suspended')->default(0);
            $table->tinyInteger('is_reg_fee_paid')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->tinyInteger('is_email_verified')->default(0);
            $table->tinyInteger('is_email_notify')->default(0);
            $table->tinyInteger('is_custom_notify')->default(0);
            $table->tinyInteger('is_heavy_subscribe')->default(0);
            $table->tinyInteger('is_dry_van_subscribe')->default(0);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
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
        Schema::dropIfExists('authorized_users');
    }
};
