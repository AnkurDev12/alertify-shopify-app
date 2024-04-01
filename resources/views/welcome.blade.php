@extends('shopify-app::layouts.default')

@section('content')

<div class="max-w-4xl mx-auto p-5">
    <h2 class="text-2xl font-bold mb-4">How to Use the App</h2>
    <ol class="list-decimal list-inside bg-white shadow-md rounded-lg p-6 space-y-4">
        <li>
            <strong>Install the App:</strong> After the successful installtion of app, by default you will get 3 tabs, Dashboard, Products and settings.
        </li>
        <li>
            <strong>Navigate to Product Tabs:</strong> Once installed, open the app from your Shopify admin dashboard. Go to the 'Products' section where you'll see a list of your products. Select a product to add a custom description.
        </li>
        <li>
            <strong>Add Custom Description:</strong> Once you will add custom description from our app, you will see the meta feild in respective product in admin with it's key and value.
        </li>
        <li>
            <strong>Inject the code:</strong> Once app will install successfully it will inject the app liquid code in the <code>main-product.liquid</code> file. If theme don't have <code>main-product.liquid</code> file then it will inject the code in <code>layout/theme.liquid</code> file and then after you will have to paste the liquid code in your theme's main product liquid file.
        </li>
        <li>
            <strong>Add snippet Manually:</strong> To display the custom description on your product page in the desired section, copy & paste the following Liquid code into your product template file:
            <div class="bg-gray-100 text-gray-800 font-mono rounded p-4 mt-2">
                <code>
                    &#123;&#123;% if product.metafields.alertify-custom-description and product.metafields.alertify-custom-description.custom-description!=blank %&#125;&#125;
                    <div class="custom-description">
                        &#123;&#123; product.metafields.alertify-custom-description.custom-description &#125;&#125;
                    </div>
                    &#123;&#123;% endif %&#125;&#125;
                </code>
            </div>
        </li>
    </ol>
    <p class="mt-4">For detailed instructions and support, visit our <a href="#" target="_blank" class="text-blue-500 hover:underline">Loom Video</a>.</p>
</div>


@endsection