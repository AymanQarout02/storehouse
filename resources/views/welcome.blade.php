<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Storehouse Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white antialiased">
<div class="min-h-screen flex flex-col items-center justify-center px-6 relative overflow-hidden">

    <div class="absolute w-72 h-72 bg-blue-500 opacity-30 rounded-full blur-3xl top-10 left-10 animate-pulse"></div>
    <div class="absolute w-96 h-96 bg-purple-600 opacity-30 rounded-full blur-3xl bottom-10 right-10 animate-pulse"></div>

    <h1 class="text-4xl md:text-6xl font-extrabold text-center mb-4 leading-tight">
        Storehouse <span class="text-blue-400">Management</span> System
    </h1>

    <p class="text-lg md:text-xl text-gray-300 text-center max-w-2xl mb-8">
        A modern way to manage your products, track inventory, and analyze data —
        built for efficiency and scalability.
    </p>

    <div class="space-x-4">
        <a href="{{ route('login') }}"
           class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-lg font-semibold transition transform hover:scale-105 shadow-lg">
             Login
        </a>
        <a href="{{ route('register') }}"
           class="px-6 py-3 bg-gray-800 hover:bg-gray-700 text-gray-200 rounded-lg text-lg font-semibold transition transform hover:scale-105 shadow-lg">
             Register
        </a>
    </div>

    <p class="absolute bottom-5 text-gray-500 text-sm">
        © {{ date('Y') }} Storehouse Management System. All rights reserved.
    </p>
</div>
</body>
</html>
