<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 text-white min-h-screen py-8">
        <div class="max-w-6xl mx-auto bg-gray-800 rounded-lg shadow-lg p-6">

            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-600 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-700 text-gray-300">
                    <th class="p-3">#</th>
                    <th class="p-3">Category Name</th>
                    <th class="p-3">Products Count</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3 font-semibold">{{ $category->name }}</td>
                        <td class="p-3">{{ $category->products_count }}</td>
                        <td class="p-3 flex justify-center gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="bg-yellow-600 hover:bg-yellow-700 px-3 py-1 rounded text-sm transition">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $categories->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
