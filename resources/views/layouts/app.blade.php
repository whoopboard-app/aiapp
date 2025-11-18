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
    @include('layouts.partials.sidebar')
    
    <div class="w-full lg:ps-64">
        @include('layouts.partials.topbar')

        <main class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
