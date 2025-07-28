<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-8">
        <div class="max-w-5xl mx-auto bg-gray-800 rounded-lg shadow-lg p-8">

            <h3 class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2">
                Add a New Product
            </h3>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-300 mb-1 font-medium">Product Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 mb-1 font-medium">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 mb-1 font-medium">Quantity</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}"
                               class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-300 mb-1 font-medium">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', 1) }}"
                               class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <x-form.category-select />
                    @include('components.form.category-select-scripts')
                </div>

                <div>
                    <label class="block text-gray-300 mb-1 font-medium">Product Image</label>
                    <input type="file" name="image"
                           class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                    @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded text-white font-semibold transition">
                        Save Product
                    </button>
                    <a href="/dashboard"
                       class="bg-gray-600 hover:bg-gray-500 px-5 py-2 rounded text-white font-semibold transition">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

