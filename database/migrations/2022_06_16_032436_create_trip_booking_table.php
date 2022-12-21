<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_booking', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('profile_id');
            $table->string('identification_option', 250)->nullable();
            $table->string('local_operator', 255)->nullable();
            $table->string('tourist_facility', 255)->nullable();
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
        Schema::dropIfExists('trip_booking');
    }
}
