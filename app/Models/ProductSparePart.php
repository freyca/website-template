<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductSparePart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'price_with_discount',
        'price_when_user_owns_product',
        'published',
        'stock',
        'slogan',
        'meta_description',
        'short_description',
        'description',
        'main_image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
