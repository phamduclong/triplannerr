<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_reports', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('title');
            $table->string('slug', 255)->nullable();
            $table->string('category_id', 255)->nullable();
            $table->date('report_startdate')->nullable();
            $table->date('report_enddate')->nullable();
            $table->string('country_departure')->nullable();
            $table->string('country_destination', 255)->nullable();
            $table->integer('no_of_participants')->nullable();
            $table->string('travel_time')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('lattitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('accessibility', ['public', 'private', 'Dedicated', 'Followers', 'Reserved'])->default('public');
            $table->enum('report_option', ['report', 'diary', 'offer'])->default('report');
            $table->enum('security_option', ['private', 'public', 'reserved'])->default('public');
            $table->string('image_audio', 250)->nullable();
            $table->integer('no_of_carries')->nullable();
            $table->integer('currency_id')->nullable();
            $table->string('slider_type', 250)->nullable();
            $table->string('slider_video', 255)->nullable();
            $table->string('slider_video_type', 255)->nullable();
            $table->text('agency_context')->nullable();
            $table->string('agency_logo', 255)->nullable();
            $table->string('links', 255)->nullable();
            $table->string('total_exp', 255)->nullable();
            $table->string('touristic_operator', 255)->nullable();
            $table->integer('contacts')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->float('total_cost', 10, 0)->nullable();
            $table->float('individual_costs', 10, 0)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->float('travel_cost', 10);
            $table->string('travel_offer', 255)->nullable();
            $table->string('sentimental_situation', 255)->nullable();
            $table->string('type_of_travel', 255)->nullable();
            $table->string('type_of_accommodation', 255)->nullable();
            $table->string('vector_type', 255)->nullable();
            $table->string('type_of_participants', 255)->nullable();
            $table->string('preferred_travel_budget', 255)->nullable();
            $table->string('preferred_type', 255)->nullable();
            $table->string('travel_favoritemealtype', 255)->nullable();
            $table->string('identification_option', 255)->nullable();
            $table->string('local_operator', 255)->nullable();
            $table->string('tourist_facility', 255)->nullable();
            $table->integer('birth_place')->nullable();
            $table->string('travel_pro', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_reports');
    }
}
