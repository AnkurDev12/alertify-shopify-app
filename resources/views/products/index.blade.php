@extends ('shopify-app::layouts.default')

@section('title', 'Product Selection')

@section('header', 'Select a Product')

@section('content')

@if(session('success'))
    <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-message').remove();">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 01-1.697 0L10 11.819l-2.651 3.03a1.2 1.2 0 01-1.697-1.697l3.03-2.651-3.03-2.651a1.2 1.2 0 011.697-1.697l2.651 3.03 2.651-3.03a1.2 1.2 0 011.697 1.697l-3.03 2.651 3.03 2.651a1.2 1.2 0 010 1.697z"/></svg>
        </button>
    </div>
@endif

<table class="table-auto w-full bg-white">
    <thead>
        <tr>
        <th class="px-4 py-2 text-left">Product Title</th>
        <th class="px-4 py-2 text-left">Product Alert Description</th>
        <th class="px-4 py-2 text-left">Product Status</th>
        <th class="px-4 py-2 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($paginatedProducts as $product)
        <tr>
                <td class="border px-4 py-2">
                    <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-sm leading-5 font-medium text-gray-900">{{ $product['title'] }}</div>
                        </div>
                    </div>
                </td>
                <td class="border px-4 py-2">
                    {{ \App\Models\Product::where('store_product_id', $product['id'])->first()->custom_description ?? '' }}
                </td>
                <td class="border px-4 py-2">
                    {{ $product['status'] }}
                </td>
                <td class="border px-4 py-2">
                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('products.description.form', $product['id']) }}">Edit Description</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $paginatedProducts->links() }}
@endsection

<script>
    setTimeout(function () {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.transition = 'opacity 0.5s';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 300);
        }
    }, 3000);
</script>

