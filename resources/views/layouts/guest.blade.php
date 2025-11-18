<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'InsightHQ') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-neutral-900">
    <main class="w-full max-w-md mx-auto p-6">
        <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
            <div class="p-4 sm:p-7">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">InsightHQ</h1>
                </div>

                <!-- Content -->
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <p class="mt-3 text-center text-sm text-gray-600 dark:text-neutral-400">
            {{ date('Y') }} InsightHQ. All rights reserved.
        </p>
    </main>
    @livewireScripts
</body>
</html>
