<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProductDeleted;
use Illuminate\Support\Facades\Storage;

class DeleteProductImages
{
    public function handle(ProductDeleted $event): void
    {
        $images = $event->product->images;
        /** @var string $disk_path */
        $disk_path = config('filament.default_filesystem_disk');
        $disk = Storage::disk($disk_path);

        foreach ($images as $image) {
            $image_abs_path = '/product-images/'.$image;

            if ($disk->exists($image_abs_path)) {
                $disk->delete($image_abs_path);
            }
        }
    }
}
