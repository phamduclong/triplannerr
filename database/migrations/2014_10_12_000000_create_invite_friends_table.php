<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersTable.
 */
class CreateInviteFriendsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invite_friends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('contact')->nullable(true);
            $table->string('status_invitation')->nullable(true);

            
            $table->timestamp('date_invite')->nullable(true);
           
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invite_friends');
    }
}
