<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmaildetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emaildetails', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 255);
            $table->string('subject', 255)->nullable();
            $table->string('content', 255)->nullable();
            $table->string('sent_to', 100)->nullable();
            $table->string('sent_from', 100)->nullable();
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
        Schema::dropIfExists('emaildetails');
    }
}
