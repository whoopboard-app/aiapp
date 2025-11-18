<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings - {{ config('app.name', 'InsightHQ') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-neutral-900">

    @include('layouts.partials.sidebar')
    @include('layouts.partials.topbar')

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" class="lg:ps-65 pt-15 pb-10 sm:pb-16">
        <div class="p-2 sm:p-5 sm:py-0 md:pt-5">
            <div class="flex gap-x-5">
                <!-- Settings Sidebar -->
                <aside class="hidden lg:block lg:w-64 shrink-0">
                    <div class="sticky top-20">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-gray-800 dark:text-neutral-200 mb-3">
                                    Settings
                                </h3>
                                <nav class="space-y-1">
                                    <!-- General -->
                                    <a href="{{ route('settings.general') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.general') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                                        General
                                    </a>

                                    <!-- Invite -->
                                    <a href="{{ route('settings.invite') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.invite') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        Invite
                                    </a>

                                    <!-- Script (Coming Soon) -->
                                    <a href="{{ route('settings.script') }}"
                                       class="flex items-center justify-between gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.script') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <div class="flex items-center gap-x-2">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                                            Script
                                        </div>
                                        <span class="text-xs px-1.5 py-0.5 bg-gray-100 text-gray-600 rounded dark:bg-neutral-700 dark:text-neutral-400">Soon</span>
                                    </a>

                                    <!-- Status Workflow -->
                                    <a href="{{ route('settings.status-workflow') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.status-workflow') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
                                        Status Workflow
                                    </a>

                                    <!-- Topics & Tags -->
                                    <a href="{{ route('settings.topics-tags') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.topics-tags') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" x2="7.01" y1="7" y2="7"/></svg>
                                        Topics & Tags
                                    </a>

                                    <!-- Changelog Settings -->
                                    <a href="{{ route('settings.changelog') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.changelog') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        Changelog
                                    </a>

                                    <!-- Themes -->
                                    <a href="{{ route('settings.themes') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.themes') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
                                        Themes
                                    </a>

                                    <!-- Billing & Subscription Header -->
                                    <div class="pt-3 pb-2">
                                        <h4 class="px-3 text-xs font-semibold uppercase text-gray-500 dark:text-neutral-500">
                                            Billing & Subscription
                                        </h4>
                                    </div>

                                    <!-- Plan -->
                                    <a href="{{ route('settings.plan') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.plan') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                        Plan
                                    </a>

                                    <!-- Billing -->
                                    <a href="{{ route('settings.billing') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.billing') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                        Billing
                                    </a>

                                    <!-- Plans -->
                                    <a href="{{ route('settings.plans') }}"
                                       class="flex items-center gap-x-2 px-3 py-2 text-sm rounded-lg {{ request()->routeIs('settings.plans') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-500' : 'text-gray-700 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        Plans
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- End Settings Sidebar -->

                <!-- Settings Content Area -->
                <div class="flex-1 min-w-0">
                    @if (session('success'))
                        <div class="mb-5 bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-500/10 dark:border-teal-500/20 dark:text-teal-500" role="alert">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
                                <div class="grow">
                                    <p class="font-semibold">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
                <!-- End Settings Content Area -->
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    @livewireScripts
</body>
</html>
