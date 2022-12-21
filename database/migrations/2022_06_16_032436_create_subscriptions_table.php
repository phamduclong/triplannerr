<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('plan_id')->nullable();
            $table->integer('plan_month_id')->nullable();
            $table->string('plan_name', 255);
            $table->float('plan_amount', 10);
            $table->integer('quantity');
            $table->float('discount_amount', 10, 0)->default(0);
            $table->float('discount_percent', 10, 0)->default(0);
            $table->float('paid_amount', 10, 0)->default(0);
            $table->string('currency', 91)->nullable();
            $table->string('payment_method', 91)->nullable();
            $table->string('token_id')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('corelation_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->dateTime('subs_start_date')->nullable();
            $table->dateTime('subs_end_date')->nullable();
            $table->integer('invoice_id');
            $table->string('invoice_description', 255);
            $table->enum('payment_status', ['pending', 'success'])->default('pending');
            $table->enum('status', ['1', '0'])->default('0');
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
        Schema::dropIfExists('subscriptions');
    }
}
