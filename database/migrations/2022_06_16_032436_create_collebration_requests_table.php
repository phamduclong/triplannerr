<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollebrationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collebration_requests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('request_id');
            $table->string('blog_service', 255);
            $table->string('role_type', 255);
            $table->longText('message');
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
        Schema::dropIfExists('collebration_requests');
    }
}
