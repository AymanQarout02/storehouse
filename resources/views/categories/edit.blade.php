<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-900 text-white min-h-screen">
        <div class="max-w-3xl mx-auto bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">Name</label>
                    <input type="text" name="name" value="{{ $category->name }}"
                           class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                    @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white font-semibold">
                    Save Category
                </button>
                <a href="{{ route('categories.index') }}"
                   class="ml-2 text-gray-400 hover:underline">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</x-app-layout>
