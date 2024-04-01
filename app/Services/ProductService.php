<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getPaginatedProducts($shop)
    {
        $getProductFromStore = $shop->api()->rest('GET', '/admin/api/2024-01/products.json', ['limit' => 250])['body']['products'];
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $products = collect($getProductFromStore);
        $currentItems = $products->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        
        return new LengthAwarePaginator($currentItems, count($products), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    }

    public function getProductDescription($product_id)
    {
        return Product::where('store_product_id', $product_id)->first();
    }

    public function storeProductDescription($request)
    {
        $shop = Auth::user();
        $shop_domain = $shop->getDomain()->toNative();
        $updateProduct = Product::updateOrCreate(
            ['store_product_id' => $request->product_id],
            [
                'custom_description' => $request->description, 
                'shop_domain' => $shop_domain
            ]
        );

        $metafieldData = [
            'namespace' => 'alertify-custom-description',
            'key' => 'custom-description',
            'value' => $updateProduct->custom_description,
            'type' => 'single_line_text_field'
        ];

        $response = $this->createProductMetafield($request->product_id, $metafieldData)['body'];

        if ($response['metafield']) {
            echo "Metafield created!";
        }
    }

    private function createProductMetafield($productId, $metafieldData)
    {
        $shop = Auth::user();
        return $shop->api()->rest("POST", "/admin/api/2024-01/products/{$productId}/metafields.json", ['metafield' => $metafieldData]);
    }
}
