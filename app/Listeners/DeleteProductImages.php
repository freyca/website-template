<?php

namespace App\Listeners;

use App\Events\ProductDeleted;
use Illuminate\Support\Facades\Storage;

class DeleteProductImages
{
    public function handle(ProductDeleted $event): void
    {
        $images = $event->product->images;
        $disk = Storage::disk(config('filament.default_filesystem_disk'));

        foreach ($images as $image) {
            $image_abs_path = '/product-images/' . $image;

            if ($disk->exists($image_abs_path)) {
                $disk->delete($image_abs_path);
            }
        }
    }
}
