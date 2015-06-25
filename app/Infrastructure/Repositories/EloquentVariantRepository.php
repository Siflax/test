<?php namespace App\Infrastructure\Repositories;


use App\Domain\Products\Variants\Variant;
use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Infrastructure\Shopify\ShopifyProductConnector;

class EloquentVariantRepository implements VariantRepositoryInterface {


    private $shopifyProductConnector;

    function __construct(ShopifyProductConnector $shopifyProductConnector)
    {
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function firstOrNewByProduct($product, $parameters = [])
    {
        return $product->variants()->firstOrNew($parameters);
    }


    public function delete($id, $shopId)
    {
        $variant = Shop::findOrFail($shopId)
            ->variants()
            ->find($id);


        $variant->delete();

        $this->deleteProductIfNoVariants($variant);
    }

    /**
     * Deletes the product if it does not have any variant rules saved
     *
     * @param $variant
     */
    public function deleteProductIfNoVariants($variant)
    {
        $product = $variant->product()->first();

        if (!$product->variants()->first()) $product->delete();
    }

    public function retrievePaginatedByShop($shop, $withShopifyDetails = false)
    {
        $variants = $shop->variants()->paginate(10);

        if ($withShopifyDetails) $variants = $this->getShopifyDetails($variants);

        return $variants;
    }

    public function getShopifyDetails($variants)
    {
        foreach ($variants as $key => $value) {
            $variants[$key] = $this->shopifyProductConnector->getVariantDetails($variants[$key]);
        }
        return $variants;
    }




    public function updateOrCreateByShop($shop, $parameters = [], $update)
    {
        $variant = $this->firstOrCreateByShop($shop, $parameters);

        $variant->update($update);

        return $variant;
    }

    public function firstOrCreateByShop($shop, $parameters = [])
    {
        $variant = $shop->variants()->find($parameters)->first();

        if ($variant) return $variant;

        $variant = Variant::create($parameters);
        $shop->variants()->save($variant);

        return $variant;
    }


}