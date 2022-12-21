<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportProTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_pro_type', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('travel_report_id');
            $table->string('offer', 255)->nullable();
            $table->string('operator', 255)->nullable();
            $table->string('facility', 255)->nullable();
            $table->float('offer_cost', 20)->nullable();
            $table->float('operator_cost', 20)->nullable();
            $table->float('facility_cost', 20)->nullable();
            $table->enum('status', ['1', '0'])->default('1');
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
        Schema::dropIfExists('report_pro_type');
    }
}
