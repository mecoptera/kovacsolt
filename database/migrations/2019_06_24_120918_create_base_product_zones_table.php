<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseProductZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_product_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('base_product_id');
            $table->string('name');
            $table->float('width');
            $table->float('height');
            $table->float('left');
            $table->float('top');
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
        Schema::dropIfExists('base_product_zones');
    }
}
