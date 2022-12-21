<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_card', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('departure_from_date');
            $table->timestamp('departure_to_date')->default('0000-00-00 00:00:00');
            $table->integer('price');
            $table->integer('payment_percentage');
            $table->integer('min_participants');
            $table->integer('max_participants')->nullable();
            $table->enum('payment_option', ['bank', 'online'])->default('online');
            $table->string('paypal_id', 100)->nullable();
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
        Schema::dropIfExists('public_card');
    }
}
