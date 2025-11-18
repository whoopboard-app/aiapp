<div class="p-2 sm:p-5 sm:py-0 md:pt-5">
    <!-- Back Button and Actions -->
    <div class="mb-5 flex items-center justify-between">
        <a
            href="{{ route('changelog.index') }}"
            wire:navigate
            class="inline-flex items-center gap-x-2 text-sm text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200"
        >
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            Back to Changelogs
        </a>

        <!-- Action Buttons -->
        <div class="flex items-center gap-x-2">
            <a
                href="{{ route('changelog.edit', $changelog->id) }}"
                wire:navigate
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit
            </a>
            <button
                type="button"
                wire:click="deleteChangelog"
                wire:confirm="Are you sure you want to delete this changelog?"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                Delete
            </button>
        </div>
    </div>

    <!-- Article Content -->
    <article class="bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Cover Image -->
        @if($changelog->cover_image)
            <div class="w-full">
                <img
                    src="{{ Storage::url($changelog->cover_image) }}"
                    alt="{{ $changelog->title }}"
                    class="w-full h-80 object-cover rounded-t-xl"
                >
            </div>
        @endif

        <!-- Content -->
        <div class="p-8 md:p-12">
            <!-- Status Badge -->
            <div class="mb-4">
                @if($changelog->status === 'published')
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-sm font-medium bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                        Published
                    </span>
                @elseif($changelog->status === 'scheduled')
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-500">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Scheduled for {{ $changelog->published_at->format('M d, Y \a\t H:i') }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-500/10 dark:text-gray-500">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Draft
                    </span>
                @endif
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ $changelog->title }}
            </h1>

            <!-- Meta Information -->
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-600 dark:text-neutral-400 mb-6 pb-6 border-b border-gray-200 dark:border-neutral-700">
                <!-- Category -->
                @if($changelog->category)
                    <div class="inline-flex items-center gap-x-2">
                        <div class="w-3 h-3 rounded-full" style="background-color: {{ $changelog->category->color_code }};"></div>
                        <span class="font-medium">{{ $changelog->category->name }}</span>
                    </div>
                @endif

                <!-- Author -->
                <div class="inline-flex items-center gap-x-1.5">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span>{{ $changelog->author_name }}</span>
                </div>

                <!-- Published Date -->
                <div class="inline-flex items-center gap-x-1.5">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span>{{ $changelog->published_at->format('F d, Y') }}</span>
                </div>
            </div>

            <!-- Tags -->
            @if($changelog->tags->count() > 0)
                <div class="mb-6">
                    <div class="flex flex-wrap gap-2">
                        @foreach($changelog->tags as $tag)
                            <span class="inline-flex items-center py-1.5 px-3 rounded-full text-sm font-medium bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Short Description -->
            <div class="text-lg text-gray-700 dark:text-neutral-300 mb-8 leading-relaxed">
                {{ $changelog->short_description }}
            </div>

            <!-- Full Description -->
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <div class="text-gray-800 dark:text-neutral-200 whitespace-pre-wrap leading-relaxed">
                    {{ $changelog->description }}
                </div>
            </div>

            <!-- Footer Meta -->
            <div class="mt-12 pt-8 border-t border-gray-200 dark:border-neutral-700">
                <div class="flex items-center justify-between text-sm text-gray-500 dark:text-neutral-400">
                    <div>
                        Created {{ $changelog->created_at->diffForHumans() }}
                    </div>
                    @if($changelog->created_at != $changelog->updated_at)
                        <div>
                            Last updated {{ $changelog->updated_at->diffForHumans() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </article>
</div>
