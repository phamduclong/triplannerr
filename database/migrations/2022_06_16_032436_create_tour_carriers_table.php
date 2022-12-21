<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_carriers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->enum('graphic_type', ['icon', 'image'])->nullable();
            $table->string('graphic_content')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('tour_carriers');
    }
}
