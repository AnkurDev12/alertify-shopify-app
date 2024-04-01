@extends ('shopify-app::layouts.default')

@section('content')

<div class="container mx-auto mt-10">
    <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-800 text-white font-bold">
                    Edit Description for Product ID: {{ $product_id }}
                </div>
                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product_id }}">
                        
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $description->custom_description ?? '' }}</textarea>
                        </div>
                        
                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-gray-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Save Description
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection