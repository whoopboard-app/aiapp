<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="relative min-h-full">
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
    <!-- ========== HEADER ========== -->
    <header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 bg-white border-b border-gray-200 dark:bg-neutral-900 dark:border-neutral-700">
        <div class="max-w-[85rem] flex justify-center basis-full items-center w-full mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <!-- Logo -->
            <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-hidden focus:opacity-80" href="/" aria-label="InsightHQ">
                <span class="text-indigo-600">Insight</span><span class="text-gray-900 dark:text-white">HQ</span>
            </a>
            <!-- End Logo -->
        </div>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- Content -->
    {{ $slot }}

    <!-- ========== FOOTER ========== -->
    <footer class="mt-auto h-23 sm:h-16 absolute bottom-0 inset-x-0 bg-white border-t border-gray-200 dark:bg-neutral-900 dark:border-neutral-700">
        <div class="w-full max-w-5xl py-6 mx-auto px-4 sm:px-6 lg:px-8">
            <!-- List -->
            <ul class="flex flex-wrap justify-center items-center whitespace-nowrap gap-3">
                <li class="inline-flex items-center relative text-xs text-gray-500 pe-3.5 last:pe-0 last:after:hidden after:absolute after:top-1/2 after:end-0 after:inline-block after:size-[3px] after:bg-gray-400 after:rounded-full after:-translate-y-1/2 dark:text-neutral-500 dark:after:bg-neutral-600">
                    © {{ date('Y') }} InsightHQ.
                </li>
                <li class="inline-flex items-center relative text-xs text-gray-500 pe-3.5 last:pe-0 last:after:hidden after:absolute after:top-1/2 after:end-0 after:inline-block after:size-[3px] after:bg-gray-400 after:rounded-full after:-translate-y-1/2 dark:text-neutral-500 dark:after:bg-neutral-600">
                    <a class="text-xs text-gray-500 underline-offset-4 hover:underline hover:text-gray-800 focus:outline-hidden focus:underline focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
                        Terms
                    </a>
                </li>
                <li class="inline-flex items-center relative text-xs text-gray-500 pe-3.5 last:pe-0 last:after:hidden after:absolute after:top-1/2 after:end-0 after:inline-block after:size-[3px] after:bg-gray-400 after:rounded-full after:-translate-y-1/2 dark:text-neutral-500 dark:after:bg-neutral-600">
                    <a class="text-xs text-gray-500 underline-offset-4 hover:underline hover:text-gray-800 focus:outline-hidden focus:underline focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200" href="#">
                        Privacy
                    </a>
                </li>
            </ul>
            <!-- End List -->
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->

    @livewireScripts
</body>
</html>
