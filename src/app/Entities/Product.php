<?php

namespace VCComponent\Laravel\Product\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use VCComponent\Laravel\Product\Contracts\ProductManagement;
use VCComponent\Laravel\Product\Contracts\ProductSchema;
use VCComponent\Laravel\Product\Entities\ProductAttribute;
use VCComponent\Laravel\Product\Entities\Variant;
use VCComponent\Laravel\Product\Traits\ProductManagementTrait;
use VCComponent\Laravel\Product\Traits\ProductSchemaTrait;
use VCComponent\Laravel\Tag\Traits\HasTagsTraits;
use Spatie\MediaLibrary\Models\Media;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements Transformable, ProductSchema, ProductManagement, HasMedia
{
    use TransformableTrait, ProductSchemaTrait, ProductManagementTrait, Sluggable, SluggableScopeHelpers, HasTagsTraits, SoftDeletes, HasMediaTrait;

    const STATUS_PENDING   = 0;
    const STATUS_PUBLISHED = 1;

    const HOT = 1;

    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'price',
        'original_price',
        'unit_price',
        'thumbnail',
        'quantity',
        'sold_quantity',
        'is_hot',
        'author_id',
        'published_date',
        'product_type',
        'sku',
        'order',
    ];

    public $registerMediaConversionsUsingModelInstance = true;

    public function registerMediaConversions(Media $media = null)
    {
        $dimensionNameSmall = 'Small';
        $dimensionSmallID = ProductImagesDimensionName::where('name', $dimensionNameSmall)->first()->id;
        $dimensionSmallWidthID = ProductImagesDimension::where('product_dimension_name_id', $dimensionSmallID)->first()->product_dimension_width_id;
        $dimensionSmallWidth = ProductImagesDimensionWidth::where('id', $dimensionSmallWidthID)->first()->value;
        $dimensionSmallHeightID = ProductImagesDimension::where('product_dimension_name_id', $dimensionSmallID)->first()->product_dimension_height_id;
        $dimensionSmallHeight = ProductImagesDimensionHeight::where('id', $dimensionSmallHeightID)->first()->value;

        $dimensionNameMedium = 'Medium';
        $dimensionMediumID = ProductImagesDimensionName::where('name', $dimensionNameMedium)->first()->id;
        $dimensionMediumWidthID = ProductImagesDimension::where('product_dimension_name_id', $dimensionMediumID)->first()->product_dimension_width_id;
        $dimensionMediumWidth = ProductImagesDimensionWidth::where('id', $dimensionMediumWidthID)->first()->value;
        $dimensionMediumHeightID = ProductImagesDimension::where('product_dimension_name_id', $dimensionMediumID)->first()->product_dimension_height_id;
        $dimensionMediumHeight = ProductImagesDimensionHeight::where('id', $dimensionMediumHeightID)->first()->value;

        $dimensionNameLarge = 'Large';
        $dimensionLargeID = ProductImagesDimensionName::where('name', $dimensionNameLarge)->first()->id;
        $dimensionLargeWidthID = ProductImagesDimension::where('product_dimension_name_id', $dimensionLargeID)->first()->product_dimension_width_id;
        $dimensionLargeWidth = ProductImagesDimensionWidth::where('id', $dimensionLargeWidthID)->first()->value;
        $dimensionLargeHeightID = ProductImagesDimension::where('product_dimension_name_id', $dimensionLargeID)->first()->product_dimension_height_id;
        $dimensionLargeHeight = ProductImagesDimensionHeight::where('id', $dimensionLargeHeightID)->first()->value;

        $this->addMediaConversion('thumb')->width(config('vc-media-manager.thumb_size.width'))->height(config('vc-media-manager.thumb_size.height'))->sharpen(10);
        $this->addMediaConversion($dimensionNameSmall)->width($dimensionSmallWidth)->height($dimensionSmallHeight)->sharpen(10);
        $this->addMediaConversion($dimensionNameMedium)->width($dimensionMediumWidth)->height($dimensionMediumHeight)->sharpen(10);
        $this->addMediaConversion($dimensionNameLarge)->width($dimensionLargeWidth)->height($dimensionLargeHeight)->sharpen(10);

    }

    public function schema()
    {
        return [
            'alt_image' => [
                'type' => 'string',
                'rule' => [],
            ],
        ];
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id');
    }

    public function scopeHot($query)
    {
        return $query->where('is_hot', self::HOT);
    }

    public function productHasSale()
    {
        $price        = $this->price;
        $origin_price = $this->original_price;

        $percent_sale = null;
        if ($price < $origin_price) {
            $caculate     = (100 - ($price * 100 / $origin_price));
            $integer_part = explode('.', $caculate);

            if ($integer_part[0] <= 3) {
                $percent_sale = "- " . number_format($origin_price - $price) . " đ";
            } else {
                $percent_sale = "- " . $integer_part[0] . " %";
            }
        }

        return $percent_sale;
    }

    public function productPrice()
    {
        $price = $this->price;
        return number_format($price) . $this->unit_price;
    }

    public function productOriginPrice()
    {
        $price = $this->original_price;
        return number_format($price) . $this->unit_price;
    }

    public function attributesValue()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function ableToUse($user)
    {
        return true;
    }

    public function productMediaDimension()
    {
        return $this->hasMany(ProductMediaDimension::class);
    }
}
