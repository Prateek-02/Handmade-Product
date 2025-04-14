<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Handmade Marketplace') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=nunito:300,400,600,700&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    <style>
        .page-transition {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 via-white to-indigo-50 text-gray-800">
    <div class="min-h-screen flex flex-col">

        {{-- 🧭 Top Navigation --}}
        @include('layouts.navigation')

        {{-- 🧱 Page Header --}}
        @isset($header)
            <header class="bg-white shadow-sm border-b border-indigo-100">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- 🌐 Main Content --}}
        <main class="py-8 flex-grow page-transition">
            {{ $slot }}
        </main>
        
        {{-- 👣 Footer --}}
        <footer class="bg-indigo-900 text-white py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-indigo-200 hover:text-white transition duration-150">Terms</a>
                        <a href="#" class="text-indigo-200 hover:text-white transition duration-150">Privacy</a>
                        <a href="#" class="text-indigo-200 hover:text-white transition duration-150">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>