<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-900 text-white min-h-screen">
        <div class="max-w-3xl mx-auto bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Name</label>
                    <input type="text" name="name" value="{{ $product->name }}"
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">{{ $product->description }}</textarea>
                    @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Quantity</label>
                    <input type="number" name="quantity" value="{{$product->quantity }}"
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                    @error('quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                    @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    @php
                        $selectedCategories = $product->categories->map(function($category) {
                            return ['id' => $category->id, 'text' => $category->name];
                        });
                    @endphp

                    <x-form.category-select :selectedCategories="$selectedCategories" />
                    @include('components.form.category-select-scripts', ['selectedCategories' => $selectedCategories])

                </div>


                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Product Image</label>
                    @if($product->media)
                        <img src="{{ asset('storage/' . $product->media->file_path) }}"
                             alt="Current Product Image"
                             class="w-32 h-32 object-cover rounded mb-2">
                    @endif

                    <input type="file" name="image"
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                    @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white font-semibold">
                    Save Product
                </button>
                <a href="{{url()->previous()}}">Cancel</a>
            </form>


        </div>
    </div>
</x-app-layout>
