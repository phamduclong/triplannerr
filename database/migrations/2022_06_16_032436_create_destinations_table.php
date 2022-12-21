<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('destination_id', 50)->nullable();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('country_id', 50)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('wheather', 255)->nullable();
            $table->string('popular', 255)->default('0');
            $table->string('visits', 255)->default('0');
            $table->string('lattitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->timestamp('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('destinations');
    }
}
