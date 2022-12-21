<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTravelProInforToAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            //
            $table->integer('travel_pro_id')->nullable(true);
            $table->string('travel_pro_name')->nullable(true);
            $table->string('travel_pro_link')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            //
            $table->dropColumn('travel_pro_id');
            $table->dropColumn('travel_pro_name');
            $table->dropColumn('travel_pro_link');
        });
    }
}
