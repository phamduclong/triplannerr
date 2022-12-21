<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSameTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('same_trip', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('report_id');
            $table->integer('user_id');
            $table->integer('same_trip_id');
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
        Schema::dropIfExists('same_trip');
    }
}
