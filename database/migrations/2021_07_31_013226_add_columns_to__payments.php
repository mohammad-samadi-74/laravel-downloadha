<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->after('order_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('post_method')->after('address_id');
            $table->string('payment_method')->after('post_method');
            $table->string('post_date')->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_address_id_foreign');
            $table->dropColumn(['address_id','post_method','payment_method','post_date']);
        });
    }
}
