<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('user_name');
            $table->string('user_billing_address');
            $table->string('user_shipping_address');
            $table->string('user_email');
            $table->string('user_phone');
            $table->enum('shipping_type', ['personal', 'delivery']);
            $table->enum('payment_mode', ['cash', 'card']);
            $table->string('payment_reference')->nullable();
            $table->enum('payment_status', ['in_progress', 'failed', 'success'])->nullable();
            $table->enum('status', ['new', 'done']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
