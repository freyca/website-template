<?php

namespace App\DTO;

class SeoTags
{
    private string $meta_title;

    private string $meta_description;

    private array $additional_headers;

    public function __construct(
        string|object $seo_container,
        array $additional_headers = [],
    ) {
        match (true) {
            is_object($seo_container) => $this->buildFromClass($seo_container),
            default => $this->buildFromConfig($seo_container),
        };

        match (true) {
            is_string($seo_container) => $this->setAdditionalHeadersFromConfig($seo_container, $additional_headers),
            default => $this->setAdditionalHeadersFromObject($seo_container, $additional_headers),
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
        $config_seo_container = config('seo.' . $seo_container);

        if (is_null($config_seo_container)) {
            throw new \Exception("SEO tags not defined: " . $seo_container, 1);
        }

        if (count($config_seo_container) < 2) {
            throw new \Exception("SEO tags needs at least two variables", 1);
        }

        if (! isset($config_seo_container['title'])) {
            throw new \Exception("Title SEO tag not set", 1);
        }

        if (! isset($config_seo_container['description'])) {
            throw new \Exception("Description SEO tag not set", 1);
        }

        $this->meta_title = $config_seo_container['title'];
        $this->meta_description = $config_seo_container['description'];
    }

    /**
     * TODO: do not allow objects with empty tags
     */
    private function buildFromClass(object $seo_container): void
    {
        $this->meta_title = $seo_container->name;
        $this->meta_description = $seo_container->meta_description ?? '';
    }

    private function setAdditionalHeadersFromConfig(string $seo_container, array $additional_headers): void
    {
        $config_seo_container = config('seo.' . $seo_container);
        unset($config_seo_container['title']);
        unset($config_seo_container['description']);

        $this->additional_headers = array_merge($config_seo_container, $additional_headers);
    }

    /**
     * TODO: build og tags with images and so on
     */
    private function setAdditionalHeadersFromObject(object $seo_container, array $additional_headers): void
    {
        $this->additional_headers = $additional_headers;
    }
}
