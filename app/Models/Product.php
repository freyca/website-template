<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\ProductDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The event map for the model.
     *
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        'deleting' => ProductDeleted::class,
    ];

    protected $fillable = [
        'name',
        'price',
        'discount',
        'published',
        'stock',
        'slogan',
        'meta_description',
        'short_description',
        'description',
        'main_image',
        'images',
        'category_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
