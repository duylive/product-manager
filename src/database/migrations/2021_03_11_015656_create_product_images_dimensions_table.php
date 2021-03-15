<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images_dimensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_images_dimension_name_id');
            $table->unsignedBigInteger('product_images_dimension_type_id');
            $table->unsignedBigInteger('product_images_dimension_width_id');
            $table->unsignedBigInteger('product_images_dimension_height_id');
            $table->string('product_type')->default('products');
            $table->foreign('product_images_dimension_name_id')->references('id')->on('product_images_dimension_names');
            $table->foreign('product_images_dimension_type_id')->references('id')->on('product_images_dimension_types');
            $table->foreign('product_images_dimension_width_id')->references('id')->on('product_images_dimension_widths');
            $table->foreign('product_images_dimension_height_id')->references('id')->on('product_images_dimension_heights');
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
        Schema::dropIfExists('product_images_dimension');
    }
}
