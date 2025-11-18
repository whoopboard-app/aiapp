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
    @include('layouts.partials.topbar')

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" class="lg:ps-65 pt-5 pb-10 sm:pb-16">
        {{ $slot }}
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    @livewireScripts
</body>
</html>
