<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('My Products') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->count() === 0)
                <div class="bg-yellow-600 text-white p-3 rounded mb-6">
                    No products found.
                    <a href="{{ route('products.create') }}" class="underline">Create a new product</a>.
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-gray-800 rounded-lg shadow-md p-5 flex flex-col justify-between">
                        <div>
                            @if($product->media)
                                <img src="{{ asset('storage/' . $product->media->file_path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-40 object-cover rounded mb-3">
                            @endif

                            <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-300 mb-2">{{ Str::limit($product->description, 60) }}</p>
                            <p class="text-sm">Available: <span class="font-semibold">{{ $product->quantity }}</span></p>
                            <p class="text-sm mb-3">Price: <span class="font-semibold">${{ $product->price }}</span></p>


                            <div class="flex flex-wrap gap-2">
                                @foreach($product->categories as $category)
                                    <a href="/categories/{{ $category->id }}"
                                       class="bg-gray-700 hover:bg-gray-600 px-2 py-1 rounded-full text-xs transition">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 flex flex-col gap-2">
                            <a href="{{ route('products.show', $product->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-center px-3 py-2 rounded text-sm transition">
                                Show Details
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="bg-yellow-600 hover:bg-yellow-700 text-center px-3 py-2 rounded text-sm transition">
                                Edit Product
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 w-full px-3 py-2 rounded text-sm transition">
                                    Delete Product
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
