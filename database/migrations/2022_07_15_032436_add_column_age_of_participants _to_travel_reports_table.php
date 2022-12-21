<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAgeOfParticipantsToTravelReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_reports', function (Blueprint $table) {
            //
            $table->string('age_of_participants')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_reports', function (Blueprint $table) {
            //
            $table->dropColumn('age_of_participants');
        });
    }
}
