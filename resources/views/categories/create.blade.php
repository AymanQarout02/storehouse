<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-8">
        <div class="max-w-5xl mx-auto bg-gray-800 rounded-lg shadow-lg p-8">

            <h3 class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2">
                Add a New Category
            </h3>

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-300 mb-1 font-medium">Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded text-white font-semibold transition">
                        Save Category
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
