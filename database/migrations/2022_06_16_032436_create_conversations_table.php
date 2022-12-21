<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('role_type')->nullable(true);
            $table->integer('first_send')->nullable(true);
            $table->string('email_send')->nullable(true);
            $table->string('email_recieve')->nullable(true);
            $table->string('message')->nullable(true);
            $table->string('date_send')->nullable(true);
            $table->string('month_send')->nullable(true);
            $table->string('year_send')->nullable(true);
            
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
        Schema::dropIfExists('conversations');
    }
}
