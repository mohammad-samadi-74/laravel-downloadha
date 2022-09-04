<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePhoneNumberType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->change();
            $table->enum('two_factor_auth',['off','sms','email'])->default('off')->after('id');
            $table->boolean('is_superuser')->default(0)->after('two_factor_auth');
            $table->boolean('is_staff')->default(0)->after('two_factor_auth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('users',['two_factor_auth','is_superuser','is_staff']);
    }
}
