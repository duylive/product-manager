<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use VCComponent\Laravel\Product\Entities\ProductImagesDimensionName;

class SeedProductImagesDimensionNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ProductImagesDimensionName::insert ([
            [
                "name" => "Small"
            ],
            [
                "name" => "Medium"
            ],
            [
                "name" => "Large"
            ],
            [
                "name" => "Original"
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
        DB::table('product_images_dimension_names')->truncate();
    }
}
