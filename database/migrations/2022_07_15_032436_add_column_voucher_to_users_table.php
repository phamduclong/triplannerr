<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVoucherToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('voucher_five_dollar')->nullable(true);
            $table->string('voucher_twenty_five_dollar')->nullable(true);
            $table->string('voucher_fifty_dollar')->nullable(true);
            $table->string('voucher_one_month')->nullable(true);
            $table->string('voucher_three_month')->nullable(true);
            $table->string('voucher_one_year')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('voucher_five_dollar');
            $table->dropColumn('voucher_twenty_five_dollar');
            $table->dropColumn('voucher_fifty_dollar');
            $table->dropColumn('voucher_one_month');
            $table->dropColumn('voucher_three_month');
            $table->dropColumn('voucher_one_year');
        });
    }
}
