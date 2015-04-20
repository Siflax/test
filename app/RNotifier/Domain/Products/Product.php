<?php namespace App\RNotifier\Domain\Products;


class Product {

        private $id;
        private $createdAt;
        private $handle;
        private $type;
        private $publishedAt;
        private $publishedScope;
        private $templateSuffix;
        private $title;
        private $updatedAt;
        private $vendor;
        private $tags;
        private $variants;
        private $options;
        private $images;
        private $image;

        function __construct(
            $id = null,
            $createdAt = null,
            $handle = null,
            $type = null,
            $publishedAt = null,
            $publishedScope  = null,
            $templateSuffix = null,
            $title = null,
            $updatedAt = null,
            $vendor = null,
            $tags = null,
            $variants = null,
            $options = null,
            $images = null,
            $image = null
        )
        {
            $this->id = $id;
            $this->createdAt = $createdAt;
            $this->handle = $handle;
            $this->type = $type;
            $this->publishedAt = $publishedAt;
            $this->publishedScope = $publishedScope;
            $this->templateSuffix = $templateSuffix;
            $this->title = $title;
            $this->updatedAt = $updatedAt;
            $this->vendor = $vendor;
            $this->tags = $tags;
            $this->variants = $variants;
            $this->options = $options;
            $this->images = $images;
            $this->image = $image;
        }





}
/*
"body_html" => "bodyHtml",
        "created_at" => "createdAt",
        "handle" => "handle",
        "id" => "id",
        "product_type" => "productType",
        "published_at" => "publishedAt",
        "published_scope" => "publishedScope",
        "template_suffix" => "templateSuffix",
        "title" => "title",
        "updated_at" => "updatedAt",
        "vendor" => "vendor",
        "tags" => "tags",
        "variants" => "variants",
        "options" => "options",
        "images" => "images",
        "image" => "image",