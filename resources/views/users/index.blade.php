<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-900 text-white min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-600 text-white p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-800 text-gray-300">
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Role</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-700">
                            <form action="{{ route('users.update', $user->id) }}" method="POST" class="contents">
                                @csrf
                                @method('PUT')
                                <td class="p-3">
                                    <input type="text" name="name" value="{{ $user->name }}"
                                           class="bg-gray-700 text-white p-1 rounded w-full">
                                </td>
                                <td class="p-3">
                                    <input type="email" name="email" value="{{ $user->email }}"
                                           class="bg-gray-700 text-white p-1 rounded w-full">
                                </td>
                                <td class="p-3">
                                    <select name="role" class="bg-gray-700 text-white p-1 rounded w-full">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                                    </select>
                                </td>
                                <td class="p-3 text-center">
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white text-sm">
                                        Update
                                    </button>
                            </form>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white text-sm">
                                    Delete
                                </button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
