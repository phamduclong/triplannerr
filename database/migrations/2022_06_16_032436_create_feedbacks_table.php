<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->enum('feedback_type', ['user', 'tour_report'])->nullable()->default('user');
            $table->integer('feedback_id');
            $table->text('content')->nullable();
            $table->string('rating_type1')->nullable();
            $table->string('rating_type2')->nullable();
            $table->string('rating_type3')->nullable();
            $table->string('rating_type4')->nullable();
            $table->string('rating_type5')->nullable();
            $table->string('rating_type6')->nullable();
            $table->string('rating_type7')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('feedbacks');
    }
}
