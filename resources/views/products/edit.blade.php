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
                    <label class="block text-gray-300 mb-1">Categories</label>
                    <select class="js-example-basic-multiple w-full bg-gray-700 text-white border border-gray-600"
                            name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Product Image</label>
                    <input type="file" name="image"
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                    @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white font-semibold">
                    Save Product
                </button>
                <a href="{{url()->previous()}}">Cancel</a>
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
