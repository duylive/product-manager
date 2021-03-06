<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use VCComponent\Laravel\Product\Entities\ProductImagesDimensionHeight;

class SeedProductImagesDimensionHeights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ProductImagesDimensionHeight::insert ([
            [
                "value" => "100",
            ],
            [
                "value" => "200",
            ],
            [
                "value" => "300",
            ],
            [
                "value" => "400",
            ],
            [
                "value" => "500",
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('product_images_dimension_heights')->truncate();
    }
}
