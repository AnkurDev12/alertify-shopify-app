<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductService;
use App\Models\Settings;

class AlertifyController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function welcome(){
        $shop = Auth::user();
        if(Auth::user()){
            $storeExist = Settings::where('shop_domain', $shop->getDomain()->toNative())->first();
            if(!$storeExist){
                $this->addSnippetInTheme();
            }
        }
        return view('welcome');
    }

    public function index()
    {
        $shop = Auth::user();
        $paginatedProducts = $this->productService->getPaginatedProducts($shop);

        return view('products.index', compact('paginatedProducts', 'shop'));
    }

    public function editDescription($product_id)
    {
        $description = $this->productService->getProductDescription($product_id);
        return view('products.description', compact('product_id', 'description'));
    }

    public function store(Request $request)
    {
        $this->productService->storeProductDescription($request);
        $request->session()->flash('success', 'Product settings saved successfully!');
        return redirect()->route('products.index');
    }

    private function addSnippetInTheme(){
        $shop = Auth::user();
        $theme = $shop->api()->rest('GET', '/admin/api/2024-01/themes.json', ['role' => 'main']);
        $liveThemeId = $theme['body']['themes'][0]['id'];
        $targetPattern = "{%- when 'description' -%}";
        $productTemplate = $shop->api()->rest('GET', "/admin/api/2024-01/themes/{$liveThemeId}/assets.json", ['asset[key]' => 'sections/main-product.liquid']);
        if($productTemplate['status'] != 200){
            $productTemplate = $shop->api()->rest('GET', "/admin/api/2024-01/themes/{$liveThemeId}/assets.json", ['asset[key]' => 'layout/theme.liquid']);
            $targetPattern = "{% sections 'header-group' %}";
        }
        
        $productTemplateContent = $productTemplate['body']->container['asset']['value'];
        
        $customLiquidCode = <<<LIQUID

            {% if product.metafields.alertify-custom-description and product.metafields.alertify-custom-description.custom-description != blank %}
                {{ product.metafields.alertify-custom-description.custom-description }}
            {% endif %}

            LIQUID;

        $newProductTemplate = str_replace($targetPattern, $targetPattern . $customLiquidCode, $productTemplateContent);

        $updateResponse = $shop->api()->rest('PUT', "/admin/api/2024-01/themes/{$liveThemeId}/assets.json", [
            'asset' => [
                'key' => 'sections/main-product.liquid',
                'value' => $newProductTemplate
            ]
        ]);
        if($updateResponse['status'] != 200){
            $shop->api()->rest('PUT', "/admin/api/2024-01/themes/{$liveThemeId}/assets.json", [
                'asset' => [
                    'key' => 'layout/theme.liquid',
                    'value' => $newProductTemplate
                ]
            ]);
        }
        
        Settings::updateOrCreate(
            ['shop_domain' => $shop->getDomain()->toNative() ],
            ['snippet_added' => true]
        );
    }
}