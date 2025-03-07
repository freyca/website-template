<?php

declare(strict_types=1);

namespace App\DTO;

use App\Exceptions\SeoException;
use App\Models\BaseProduct;
use App\Models\Category;

class SeoTags
{
    private string $meta_title;

    private string $meta_description;

    private array $additional_headers;

    public function __construct(
        string|BaseProduct|Category $seo_container,
    ) {
        match (true) {
            is_object($seo_container) => $this->buildFromClass($seo_container),
            default => $this->buildFromConfig($seo_container),
        };

        match (true) {
            is_string($seo_container) => $this->setAdditionalHeadersFromConfig($seo_container),
            default => $this->setAdditionalHeadersFromObject($seo_container),
        };
    }

    public function getMetaTitle(): string
    {
        return $this->meta_title;
    }

    public function getMetaDescription(): string
    {
        return $this->meta_description;
    }

    public function getAdditionalHeaders(): array
    {
        return $this->additional_headers;
    }

    private function buildFromConfig(string $seo_container): void
    {
        $config_seo_container = config('seo.'.$seo_container);

        if (is_null($config_seo_container)) {
            throw new SeoException('SEO tags not defined in config: '.$seo_container);
        }

        if (count($config_seo_container) < 2) {
            throw new SeoException('SEO tags configuration needs at least two values in '.$seo_container);
        }

        if (! isset($config_seo_container['title'])) {
            throw new SeoException('Title SEO tag not set in configuration: '.$seo_container);
        }

        if (! isset($config_seo_container['description'])) {
            throw new SeoException('Description SEO tag not set in configuration: '.$seo_container);
        }

        $this->meta_title = $config_seo_container['title'];
        $this->meta_description = $config_seo_container['description'];
    }

    private function buildFromClass(BaseProduct|Category $seo_container): void
    {
        try {
            $this->meta_title = $seo_container->name ? $seo_container->name : throw new SeoException('Object does not has meta_title');
            $this->meta_description = $seo_container->meta_description ? $seo_container->meta_description : throw new SeoException('Object does not has meta_description');
        } catch (\Throwable $th) {
            throw new SeoException($th->getMessage().' '.$seo_container::class.' - ID: '.$seo_container->id);
        }
    }

    private function setAdditionalHeadersFromConfig(string $seo_container): void
    {
        $config_seo_container = config('seo.'.$seo_container);
        unset($config_seo_container['title']);
        unset($config_seo_container['description']);

        $this->additional_headers = array_merge(config('seo.default'), $config_seo_container);
    }

    /**
     * TODO: build og tags with images and so on
     */
    private function setAdditionalHeadersFromObject(object $seo_container): void
    {
        $this->additional_headers = config('seo.default');
    }
}
