<?php namespace App\Infrastructure\Adapters;


use App\Infrastructure\AntiCorruptionLayer\Adapter;
use Illuminate\Foundation\Application;

class ProductAdapter extends Adapter {

    protected $retrieveOutputDictionary = [

        "body_html" => "bodyHtml",
        "created_at" => "createdAt",
        "handle" => "handle",
        "id" => "id",
        "product_type" => "type",
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
    ];

    private $factory;

    function __construct(ProductFactory $factory)
    {
        $this->factory = $factory;
        parent::__construct();
    }

    public function newProductFromApi($attributes, $method)
    {
        $entityParameters = $this->toEntityParameters($attributes,$method);

        $product = $this->factory->create($entityParameters);

        return $product;
    }
}