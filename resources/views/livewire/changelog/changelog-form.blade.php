<div class="p-2 sm:p-5 sm:py-0 md:pt-5">
    <!-- Page Header -->
    <div class="mb-5">
        <div class="flex items-center gap-x-3">
            <a href="{{ route('changelog.index') }}" wire:navigate class="text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    {{ $changelogId ? 'Edit Changelog' : 'Add Changelog' }}
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                    {{ $changelogId ? 'Update your changelog entry' : 'Create a new changelog entry' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="save">
        <div class="bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-5 md:p-7 space-y-5">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="title"
                        placeholder="Enter changelog title"
                        class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Cover Image
                    </label>

                    @if($existing_cover_image && !$cover_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($existing_cover_image) }}" alt="Cover" class="h-32 rounded-lg object-cover">
                        </div>
                    @endif

                    @if($cover_image)
                        <div class="mb-3">
                            <img src="{{ $cover_image->temporaryUrl() }}" alt="Preview" class="h-32 rounded-lg object-cover">
                        </div>
                    @endif

                    <input
                        type="file"
                        wire:model="cover_image"
                        accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    >
                    @error('cover_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div wire:loading wire:target="cover_image" class="mt-2 text-sm text-gray-500">Uploading...</div>
                </div>

                <!-- Short Description -->
                <div>
                    <label for="short_description" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Short Description (Min 200 Characters) <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="short_description"
                        wire:model.defer="short_description"
                        rows="3"
                        maxlength="200"
                        placeholder="Enter a brief description (exactly 200 characters)"
                        class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 @error('short_description') border-red-500 @enderror"
                    ></textarea>
                    <p class="mt-1 text-xs text-gray-500">{{ strlen($short_description) }}/200 characters</p>
                    @error('short_description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="description"
                        wire:model.defer="description"
                        rows="10"
                        placeholder="Enter full description"
                        class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 @error('description') border-red-500 @enderror"
                    ></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="changelog_category_id" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Category
                    </label>
                    <select
                        id="changelog_category_id"
                        wire:model.defer="changelog_category_id"
                        class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 @error('changelog_category_id') border-red-500 @enderror"
                    >
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('changelog_category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags_input" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Tags
                    </label>

                    <!-- Selected Tags -->
                    @if(count($selected_tags) > 0)
                        <div class="mb-3 flex flex-wrap gap-2">
                            @foreach($selected_tags as $index => $tag)
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-500/10 dark:text-indigo-500">
                                    {{ $tag }}
                                    <button
                                        type="button"
                                        wire:click="removeTag({{ $index }})"
                                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-full hover:bg-indigo-200 focus:outline-none dark:hover:bg-indigo-500/20"
                                    >
                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                    </button>
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Tag Input -->
                    <div class="relative">
                        <div class="flex gap-2">
                            <input
                                type="text"
                                id="tags_input"
                                wire:model.live.debounce.300ms="tags_input"
                                wire:keydown.enter.prevent="addTag"
                                placeholder="Type to search or add tags"
                                class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400"
                            >
                            <button
                                type="button"
                                wire:click="addTag"
                                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-hidden focus:bg-indigo-700"
                            >
                                Add
                            </button>
                        </div>

                        <!-- Tag Suggestions -->
                        @if($show_tag_suggestions)
                            <div class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700">
                                @foreach($tag_suggestions as $suggestion)
                                    <button
                                        type="button"
                                        wire:click="addTag('{{ $suggestion }}')"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700 first:rounded-t-lg last:rounded-b-lg"
                                    >
                                        {{ $suggestion }}
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Press Enter or click Add to add a tag</p>
                </div>

                <!-- Author Name -->
                <div>
                    <label for="author_name" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Author Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="author_name"
                        wire:model.defer="author_name"
                        placeholder="Enter author name"
                        class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 @error('author_name') border-red-500 @enderror"
                    >
                    @error('author_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published Date -->
                <div>
                    <label for="published_at" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Published Date <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        id="published_at"
                        wire:model.live="published_at"
                        class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 @error('published_at') border-red-500 @enderror"
                    >
                    @error('published_at')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if($published_at && \Carbon\Carbon::parse($published_at)->isFuture())
                        <p class="mt-1 text-xs text-blue-600">This will be scheduled for future publication</p>
                    @endif
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                        Status <span class="text-red-500">*</span>
                    </label>

                    @if($published_at && \Carbon\Carbon::parse($published_at)->isFuture())
                        <!-- Scheduled Status (Read-only) -->
                        <div class="py-2 px-3 block w-full bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                            Scheduled for Published (future date selected)
                        </div>
                    @else
                        <!-- Draft or Published Options -->
                        <select
                            id="status"
                            wire:model.defer="status"
                            class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 @error('status') border-red-500 @enderror"
                        >
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    @endif

                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Footer -->
            <div class="flex justify-end items-center gap-x-2 py-3 px-5 md:px-7 border-t border-gray-200 dark:border-neutral-700">
                <button
                    type="button"
                    wire:click="cancel"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-indigo-700"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="save">{{ $changelogId ? 'Update' : 'Create' }} Changelog</span>
                    <span wire:loading wire:target="save">
                        <svg class="animate-spin inline-block size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving...
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>
