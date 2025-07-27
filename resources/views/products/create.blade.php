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
                    <label class="block text-gray-300 mb-1 font-medium">Categories</label>
                    <select class="js-example-basic-multiple w-full bg-gray-700 text-white border border-gray-600 rounded focus:ring-2 focus:ring-blue-500"
                                name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
            @push('scripts')
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2({
                            placeholder: "Select categories",
                            allowClear: true
                        });
                    });
                </script>
                <style>
                    .select2-container .select2-selection--multiple {
                        background-color: #374151;
                        color: #fff;
                        border: 1px solid #4b5563;
                        border-radius: 0.375rem;
                        min-height: 42px;
                        padding: 4px;
                    }

                    .select2-container--default .select2-selection--multiple .select2-selection__choice {
                        background-color: #2563eb;
                        color: #fff;
                        border: none;
                        border-radius: 0.375rem;
                        padding: 2px 6px;
                        margin-top: 4px;
                    }

                    .select2-container--default .select2-results__option {
                        color: #000;
                    }

                    .select2-container--default .select2-results__option--highlighted {
                        background-color: #2563eb;
                        color: #fff;
                    }

                    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
                        color: #fff;
                    }
                </style>
            @endpush



        </div>
    </div>
</x-app-layout>

