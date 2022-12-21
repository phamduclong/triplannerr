<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelVectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_vectors', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 255);
            $table->integer('parent_id');
            $table->string('vector_type')->nullable();
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
        Schema::dropIfExists('travel_vectors');
    }
}
