<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelReportComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_report_component', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('travel_report_id');
            $table->string('component_name', 255);
            $table->integer('sub_component_id')->nullable()->default(0);
            $table->float('individual_cost', 20)->nullable();
            $table->float('total_cost', 10)->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->dateTime('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('travel_report_component');
    }
}
