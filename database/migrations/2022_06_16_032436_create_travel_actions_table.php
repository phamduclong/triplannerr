<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_actions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('report_id');
            $table->integer('user_id');
            $table->enum('action', ['super', 'alert', 'same trip page', 'same trip']);
            $table->enum('action_status', ['1', '0'])->default('1');
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
        Schema::dropIfExists('travel_actions');
    }
}
