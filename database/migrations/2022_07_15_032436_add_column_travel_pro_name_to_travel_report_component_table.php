<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTravelProNameToTravelReportComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_report_component', function (Blueprint $table) {
            //
            $table->string('travel_pro_name')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_report_component', function (Blueprint $table) {
            //
            $table->dropColumn('travel_pro_name');
        });
    }
}
