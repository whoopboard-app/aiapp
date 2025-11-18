<x-app-layout>
    <!-- Breadcrumb -->
    <ol class="lg:hidden pt-3 md:pt-5 sm:pb-2 md:pb-0 px-2 sm:px-5 flex items-center whitespace-nowrap">
        <li class="flex items-center text-sm text-gray-600 dark:text-neutral-500">
            Dashboard
            <svg class="shrink-0 overflow-visible size-4 ms-1.5 text-gray-400 dark:text-neutral-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round"></path>
            </svg>
        </li>
        <li class="ps-1.5 flex items-center truncate font-semibold text-gray-800 dark:text-neutral-200 text-sm truncate">
            <span class="truncate">Overview</span>
        </li>
    </ol>
    <!-- End Breadcrumb -->

    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        @if(session('success'))
            <div class="bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4" role="alert">
                <div class="flex items-center gap-x-3">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
                    <div class="grow">
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Feedback Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-x-2">
                            <div class="size-9.5 flex justify-center items-center bg-blue-100 rounded-lg dark:bg-blue-500/10">
                                <svg class="shrink-0 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            </div>
                        </div>
                        <span class="py-1 ps-1.5 pe-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                            New
                        </span>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-semibold text-gray-800 dark:text-neutral-200">
                        0
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Total Feedback
                    </p>
                </div>
            </div>
            <!-- End Total Feedback Card -->

            <!-- Changelog Entries Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-x-2">
                            <div class="size-9.5 flex justify-center items-center bg-indigo-100 rounded-lg dark:bg-indigo-500/10">
                                <svg class="shrink-0 size-4 text-indigo-600 dark:text-indigo-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/></svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-semibold text-gray-800 dark:text-neutral-200">
                        0
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Changelog Entries
                    </p>
                </div>
            </div>
            <!-- End Changelog Entries Card -->

            <!-- Knowledge Articles Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-x-2">
                            <div class="size-9.5 flex justify-center items-center bg-purple-100 rounded-lg dark:bg-purple-500/10">
                                <svg class="shrink-0 size-4 text-purple-600 dark:text-purple-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-semibold text-gray-800 dark:text-neutral-200">
                        0
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Knowledge Articles
                    </p>
                </div>
            </div>
            <!-- End Knowledge Articles Card -->

            <!-- Team Members Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-x-2">
                            <div class="size-9.5 flex justify-center items-center bg-orange-100 rounded-lg dark:bg-orange-500/10">
                                <svg class="shrink-0 size-4 text-orange-600 dark:text-orange-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-semibold text-gray-800 dark:text-neutral-200">
                        1
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        Team Members
                    </p>
                </div>
            </div>
            <!-- End Team Members Card -->
        </div>
        <!-- End Stats Grid -->

        <!-- Welcome Card -->
        <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-5 md:p-7">
                <div class="flex items-center gap-x-4 mb-5">
                    <div class="shrink-0">
                        <img class="size-16 rounded-full ring-2 ring-white dark:ring-neutral-800" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4f46e5&color=fff&size=128" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="grow">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
                            Welcome back, {{ auth()->user()->name }}!
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-neutral-500">
                            {{ auth()->user()->workspace->name }}
                        </p>
                    </div>
                </div>
                <div class="space-y-3">
                    <p class="text-gray-600 dark:text-neutral-400">
                        Get started with InsightHQ by exploring these key features:
                    </p>
                    <div class="grid sm:grid-cols-3 gap-3">
                        <a class="group flex flex-col bg-gray-50 border border-gray-200 shadow-xs hover:shadow-sm rounded-lg p-4 transition dark:bg-neutral-900 dark:border-neutral-700" href="{{ route('feedback.index') }}">
                            <div class="flex items-center gap-x-3 mb-2">
                                <svg class="shrink-0 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 dark:text-neutral-200 dark:group-hover:text-indigo-500">Feedback</h4>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">Collect and manage customer feedback</p>
                        </a>

                        <a class="group flex flex-col bg-gray-50 border border-gray-200 shadow-xs hover:shadow-sm rounded-lg p-4 transition dark:bg-neutral-900 dark:border-neutral-700" href="{{ route('changelog.index') }}">
                            <div class="flex items-center gap-x-3 mb-2">
                                <svg class="shrink-0 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/></svg>
                                <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 dark:text-neutral-200 dark:group-hover:text-indigo-500">Changelog</h4>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">Share product updates with users</p>
                        </a>

                        <a class="group flex flex-col bg-gray-50 border border-gray-200 shadow-xs hover:shadow-sm rounded-lg p-4 transition dark:bg-neutral-900 dark:border-neutral-700" href="{{ route('knowledge.index') }}">
                            <div class="flex items-center gap-x-3 mb-2">
                                <svg class="shrink-0 size-5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 dark:text-neutral-200 dark:group-hover:text-indigo-500">Knowledge Base</h4>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">Build a help center for customers</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Welcome Card -->

        <!-- Recent Activity & Quick Actions Grid -->
        <div class="grid lg:grid-cols-2 gap-5">
            <!-- Recent Activity Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-5 pb-2">
                    <h2 class="inline-block font-semibold text-lg text-gray-800 dark:text-neutral-200">
                        Recent Activity
                    </h2>
                </div>
                <div class="p-5 pt-0">
                    <div class="space-y-4">
                        <div class="flex items-center justify-center h-40">
                            <p class="text-sm text-gray-500 dark:text-neutral-500">No recent activity yet</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Recent Activity Card -->

            <!-- Quick Actions Card -->
            <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-5 pb-2">
                    <h2 class="inline-block font-semibold text-lg text-gray-800 dark:text-neutral-200">
                        Quick Actions
                    </h2>
                </div>
                <div class="p-5 pt-3">
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('feedback.index') }}" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            View Feedback
                        </a>
                        <a href="{{ route('changelog.index') }}" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/></svg>
                            Add Changelog
                        </a>
                        <a href="{{ route('testimonials.index') }}" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            Testimonials
                        </a>
                        <a href="{{ route('workspace.settings') }}" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-xs hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                            Settings
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Quick Actions Card -->
        </div>
        <!-- End Recent Activity & Quick Actions Grid -->
    </div>
</x-app-layout>
