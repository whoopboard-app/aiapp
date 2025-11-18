<div class="p-2 sm:p-5 sm:py-0 md:pt-5">
    <!-- Page Header -->
    <div class="mb-5 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Changelogs
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                Manage and publish your product updates and announcements.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-5 bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-500/10 dark:border-teal-500/20 dark:text-teal-500" role="alert">
            <div class="flex items-center gap-x-3">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
                <div class="grow">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($changelogs->total() > 0 || $search || $filterCategory || $filterStatus)
        <!-- Search and Filter Bar -->
        <div class="mb-5 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Search -->
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 ps-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                placeholder="Search changelogs..."
                                class="py-2 px-3 ps-10 block w-full border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400"
                            >
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <button
                        type="button"
                        wire:click="toggleFilters"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
                    >
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        Filters
                        @if($filterCategory || $filterStatus)
                            <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-indigo-600 rounded-full">
                                {{ ($filterCategory ? 1 : 0) + ($filterStatus ? 1 : 0) }}
                            </span>
                        @endif
                    </button>

                    <!-- Add Changelog Button -->
                    <a
                        href="{{ route('changelog.create') }}"
                        wire:navigate
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-hidden focus:bg-indigo-700"
                    >
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                        Add Changelog
                    </a>
                </div>

                <!-- Filter Options -->
                @if($showFilters)
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-neutral-700">
                        <div class="grid sm:grid-cols-3 gap-3">
                            <!-- Category Filter -->
                            <div>
                                <label class="block text-xs font-medium mb-1.5 text-gray-700 dark:text-neutral-300">Category</label>
                                <select
                                    wire:model.live="filterCategory"
                                    class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400"
                                >
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label class="block text-xs font-medium mb-1.5 text-gray-700 dark:text-neutral-300">Status</label>
                                <select
                                    wire:model.live="filterStatus"
                                    class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400"
                                >
                                    <option value="">All Statuses</option>
                                    <option value="published">Published</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>

                            <!-- Clear Filters -->
                            <div class="flex items-end">
                                <button
                                    type="button"
                                    wire:click="clearFilters"
                                    class="w-full py-2 px-3 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                >
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Changelog List -->
        <div class="space-y-3">
            @forelse($changelogs as $changelog)
                <div class="bg-white border border-gray-200 rounded-xl shadow-xs hover:shadow-md transition-shadow dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="p-5">
                        <div class="flex items-start gap-x-4">
                            <!-- Cover Image Thumbnail -->
                            @if($changelog->cover_image)
                                <div class="shrink-0">
                                    <img
                                        src="{{ Storage::url($changelog->cover_image) }}"
                                        alt="{{ $changelog->title }}"
                                        class="w-20 h-20 object-cover rounded-lg"
                                    >
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-x-4">
                                    <div class="flex-1">
                                        <!-- Status Badge -->
                                        <div class="mb-2">
                                            @if($changelog->status === 'published')
                                                <span class="inline-flex items-center gap-x-1 py-1 px-2.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500">
                                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                                    Published
                                                </span>
                                            @elseif($changelog->status === 'scheduled')
                                                <span class="inline-flex items-center gap-x-1 py-1 px-2.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-500">
                                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                    Scheduled
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-x-1 py-1 px-2.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-500/10 dark:text-gray-500">
                                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                    Draft
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Title -->
                                        <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-200 mb-1">
                                            {{ $changelog->title }}
                                        </h3>

                                        <!-- Meta Info -->
                                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500 dark:text-neutral-400">
                                            @if($changelog->category)
                                                <span class="inline-flex items-center gap-x-1">
                                                    <div class="w-2 h-2 rounded-full" style="background-color: {{ $changelog->category->color_code }};"></div>
                                                    {{ $changelog->category->name }}
                                                </span>
                                            @endif
                                            <span>{{ $changelog->author_name }}</span>
                                            <span>{{ $changelog->published_at->format('M d, Y') }}</span>
                                        </div>

                                        <!-- Tags -->
                                        @if($changelog->tags->count() > 0)
                                            <div class="mt-2 flex flex-wrap gap-1.5">
                                                @foreach($changelog->tags as $tag)
                                                    <span class="inline-flex items-center py-0.5 px-2 rounded text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-x-2">
                                        <a
                                            href="{{ route('changelog.view', $changelog->id) }}"
                                            wire:navigate
                                            class="p-2 inline-flex items-center text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-neutral-400 dark:hover:text-indigo-400"
                                            title="View"
                                        >
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a
                                            href="{{ route('changelog.edit', $changelog->id) }}"
                                            wire:navigate
                                            class="p-2 inline-flex items-center text-sm font-medium text-gray-600 hover:text-indigo-600 dark:text-neutral-400 dark:hover:text-indigo-400"
                                            title="Edit"
                                        >
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        </a>
                                        <button
                                            type="button"
                                            wire:click="deleteChangelog({{ $changelog->id }})"
                                            wire:confirm="Are you sure you want to delete this changelog?"
                                            class="p-2 inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400"
                                            title="Delete"
                                        >
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-10 text-center dark:bg-neutral-800 dark:border-neutral-700">
                    <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="mt-4 text-gray-600 dark:text-neutral-400">No changelogs found matching your criteria.</p>
                    @if($search || $filterCategory || $filterStatus)
                        <button
                            type="button"
                            wire:click="clearFilters"
                            class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 font-medium dark:text-indigo-500 dark:hover:text-indigo-400"
                        >
                            Clear filters
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $changelogs->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-10 text-center dark:bg-neutral-800 dark:border-neutral-700">
            <svg class="w-20 h-20 mx-auto text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-neutral-200">No changelogs yet</h3>
            <p class="mt-2 text-gray-600 dark:text-neutral-400">Get started by creating your first changelog to keep your users informed.</p>
            <a
                href="{{ route('changelog.create') }}"
                wire:navigate
                class="mt-5 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-hidden focus:bg-indigo-700"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                Add Changelog
            </a>
        </div>
    @endif
</div>
