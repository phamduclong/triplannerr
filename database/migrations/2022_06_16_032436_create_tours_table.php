<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('departure_id');
            $table->string('title');
            $table->text('description');
            $table->integer('no_of_days');
            $table->integer('no_of_nights');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->string('banner_image')->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('meta_descirption', 255)->nullable();
            $table->enum('status', ['pending', 'approved', 'notapproved', 'deleted'])->default('pending');
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
        Schema::dropIfExists('tours');
    }
}
