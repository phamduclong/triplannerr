<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_privileges', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('plan_id')->nullable();
            $table->string('name', 100);
            $table->string('controller', 100);
            $table->text('action')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0');
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
        Schema::dropIfExists('plan_privileges');
    }
}
