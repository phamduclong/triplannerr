<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserParticipateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_participate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('report_id')->nullable(true);
            $table->string('travel_report_name')->nullable(true);
            $table->string('date_click')->nullable(true);
            $table->string('user_name')->nullable(true);
            $table->string('link_profile')->nullable(true);
            $table->string('user_email')->nullable(true);
            $table->timestamps();
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
        Schema::dropIfExists('user_participate');
    }
}
