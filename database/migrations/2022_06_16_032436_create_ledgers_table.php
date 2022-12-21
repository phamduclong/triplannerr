<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('recordable_type');
            $table->unsignedBigInteger('recordable_id');
            $table->unsignedTinyInteger('context');
            $table->string('event');
            $table->text('properties');
            $table->text('modified');
            $table->text('pivot');
            $table->text('extra');
            $table->text('url')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('signature');
            $table->timestamps();

            $table->index(['recordable_type', 'recordable_id']);
            $table->index(['user_id', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledgers');
    }
}
