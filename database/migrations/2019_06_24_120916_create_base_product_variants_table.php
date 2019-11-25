<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('base_product_id');
            $table->unsignedInteger('base_product_view_id');
            $table->unsignedInteger('base_product_color_id');
            $table->unsignedInteger('base_product_zone_id')->nullable();
            $table->boolean('default')->default(0);
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
        Schema::dropIfExists('base_product_variants');
    }
}
