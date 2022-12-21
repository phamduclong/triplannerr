<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('view', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->enum('type', ['image', 'video'])->default('image');
            $table->string('type_file', 255)->nullable();
            $table->string('embedded_link', 255)->nullable();
            $table->string('ad_url', 100)->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('country_departure')->nullable();
            $table->integer('age')->nullable();
            $table->string('travel_type', 255)->nullable();
            $table->string('vector_type', 255)->nullable();
            $table->string('type_of_accomodation', 255)->nullable();
            $table->string('type_of_participant', 255)->nullable();
            $table->string('preffered_stay_formula', 255)->nullable();
            $table->string('type_of_fav_meal', 255)->nullable();
            $table->string('budget', 255)->nullable();
            $table->string('ads_type', 255)->nullable();
            $table->enum('status', ['1', '0'])->nullable()->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
