<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_months', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('no_of_month')->nullable();
            $table->integer('discount')->nullable()->comment('in % rate');
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
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
        Schema::dropIfExists('plan_months');
    }
}
