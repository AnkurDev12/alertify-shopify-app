<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-24 md:h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="sm:block sm:ml-3">
            <div class="flex flex-wrap justify-center md:justify-start">
                <a href="/dashboard"
                    class="@if(Request::path() == 'dashboard') bg-gray-900 @endif px-3 py-2 rounded-md text-sm font-medium leading-5 text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                    Dashboard
                </a>

                <a href="/products" class="@if(Request::path() == 'products' || Request::path() == 'products/description') bg-gray-900 @endif ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                  Products
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</nav>
