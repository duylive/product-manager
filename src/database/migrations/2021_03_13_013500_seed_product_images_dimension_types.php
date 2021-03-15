<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use VCComponent\Laravel\Product\Entities\ProductImagesDimensionType;

class SeedProductImagesDimensionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ProductImagesDimensionType::insert ([
            [
                "type" => "Thumbnail"
            ],
            [
                "type" => "Gallery"
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
        DB::table('product_images_dimension_types')->truncate();
    }
}
