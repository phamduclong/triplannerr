<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelReportSlideshowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_report_slideshow', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('travel_report_id');
            $table->string('slide_name', 150);
            $table->enum('slider_type', ['transitions', 'video_effect', 'duration'])->default('transitions');
            $table->enum('status', ['1', '0'])->default('1');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_At')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_report_slideshow');
    }
}
