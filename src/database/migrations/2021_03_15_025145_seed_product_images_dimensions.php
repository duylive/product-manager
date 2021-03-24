<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use VCComponent\Laravel\Product\Entities\ProductImagesDimension;

class SeedProductImagesDimensions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ProductImagesDimension::insert ([
            [
                "dimension_name_id" => 1,
                "dimension_type_id" => 1,
                "dimension_width_id" => 3,
                "dimension_height_id" => 2
            ],
            [
                "dimension_name_id" => 2,
                "dimension_type_id" => 1,
                "dimension_width_id" => 4,
                "dimension_height_id" => 3
            ],
            [
                "dimension_name_id" => 3,
                "dimension_type_id" => 1,
                "dimension_width_id" => 5,
                "dimension_height_id" => 4
            ],
            [
                "dimension_name_id" => 1,
                "dimension_type_id" => 2,
                "dimension_width_id" => 3,
                "dimension_height_id" => 2
            ],
            [
                "dimension_name_id" => 2,
                "dimension_type_id" => 2,
                "dimension_width_id" => 4,
                "dimension_height_id" => 3
            ],
            [
                "dimension_name_id" => 3,
                "dimension_type_id" => 2,
                "dimension_width_id" => 5,
                "dimension_height_id" => 4
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
        DB::table('product_images_dimensions')->truncate();
    }
}
