<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-white">

        <aside class="w-64 bg-gray-800 p-6 flex flex-col space-y-4">
            <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
            <a href="/products/create" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded transition">Create Product</a>
            <a href="{{ route('products.my_products') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded transition">View My Products</a>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('users.index') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded transition">Manage Users</a>
            @endif
            <a href="{{ route('products.index') }}" class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded transition">All Products</a>
            <a href="{{ route('categories.create') }}"
               class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded transition">
                Create Category
            </a>
            <a href="{{ route('categories.list') }}"
               class="block bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded transition">
                Manage Categories
            </a>

        </aside>

        <main class="flex-1 p-10">
            <div class="bg-gray-800 p-6 rounded shadow-md mb-6">
                <h1 class="text-3xl font-bold mb-2">Welcome, {{ auth()->user()->name }}</h1>
                <p class="text-gray-300">You're logged in as <span class="font-semibold">{{ auth()->user()->role }}</span>.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-800 p-6 rounded shadow-md text-center">
                    <h3 class="text-lg font-semibold">Products</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="bg-gray-800 p-6 rounded shadow-md text-center">
                    <h3 class="text-lg font-semibold">Categories</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalCategories }}</p>
                </div>
                <div class="bg-gray-800 p-6 rounded shadow-md text-center">
                    <h3 class="text-lg font-semibold">Users</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
                </div>

            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-gray-800 p-6 rounded shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Product Creation Trend (Last 7 Days)</h3>
                    <canvas id="productChart" height="150"></canvas>
                </div>
                <div class="bg-gray-800 p-6 rounded shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Products per Category</h3>
                    <canvas id="categoryChart" height="150"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const productCtx = document.getElementById('productChart').getContext('2d');
        new Chart(productCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($productTrend->keys()) !!},
                datasets: [{
                    label: 'Products Created',
                    data: {!! json_encode($productTrend->values()) !!},
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.3)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {responsive: true, scales: {y: {beginAtZero: true}}}
        });

        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoryProductCounts->keys()) !!},
                datasets: [{
                    label: 'Products',
                    data: {!! json_encode($categoryProductCounts->values()) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {x: {beginAtZero: true}}
            }
        });
    </script>
</x-app-layout>
