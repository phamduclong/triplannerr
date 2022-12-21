<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelReportGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_report_gallery', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('travel_report_id');
            $table->string('gallery_image', 150);
            $table->string('image_caption', 150);
            $table->string('image_location', 255);
            $table->string('image_sorting', 100);
            $table->string('image_lat', 255)->nullable();
            $table->string('image_long', 255)->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
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
        Schema::dropIfExists('travel_report_gallery');
    }
}
