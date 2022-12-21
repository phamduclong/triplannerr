<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_graphics', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tour_id');
            $table->string('original_image');
            $table->string('thumb_image');
            $table->string('middle_size_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_graphics');
    }
}
