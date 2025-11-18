<div class="p-2 sm:p-5 sm:py-0 md:pt-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Categories
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                Use Categories to organize your Announcements.
            </p>
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

        <!-- Add Category Form Card -->
        <div class="mb-5 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-5 md:p-7">
                <form wire:submit.prevent="addCategory" class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <!-- Category Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Category Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                wire:model.defer="name"
                                placeholder="Enter category name"
                                class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('name') border-red-500 @enderror"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="is_active" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Status
                            </label>
                            <select
                                id="is_active"
                                wire:model.defer="is_active"
                                class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600"
                            >
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                            wire:loading.attr="disabled"
                        >
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                            <span wire:loading.remove>Add Category</span>
                            <span wire:loading>Adding...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories List -->
        @if($categories->count() > 0)
            <div class="space-y-3">
                @foreach($categories as $category)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
                        @if($editingCategoryId === $category->id)
                            <!-- Inline Edit Mode -->
                            <div class="p-5">
                                <div class="grid sm:grid-cols-12 gap-4 items-start">
                                    <!-- Color Picker -->
                                    <div class="sm:col-span-1">
                                        <input
                                            type="color"
                                            wire:model.defer="color_code"
                                            class="size-10 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700"
                                            title="Pick a color"
                                        >
                                    </div>

                                    <!-- Color Code Input -->
                                    <div class="sm:col-span-2">
                                        <input
                                            type="text"
                                            wire:model.defer="color_code"
                                            placeholder="#000000"
                                            class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('color_code') border-red-500 @enderror"
                                        >
                                        @error('color_code')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Name Input -->
                                    <div class="sm:col-span-4">
                                        <input
                                            type="text"
                                            wire:model.defer="name"
                                            placeholder="Category name"
                                            class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('name') border-red-500 @enderror"
                                        >
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status Dropdown -->
                                    <div class="sm:col-span-2">
                                        <select
                                            wire:model.defer="is_active"
                                            class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600"
                                        >
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="sm:col-span-3 flex items-start gap-x-2">
                                        <button
                                            type="button"
                                            wire:click="updateCategory"
                                            wire:loading.attr="disabled"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none"
                                        >
                                            <span wire:loading.remove wire:target="updateCategory">Save</span>
                                            <span wire:loading wire:target="updateCategory">Saving...</span>
                                        </button>
                                        <button
                                            type="button"
                                            wire:click="closeEditModal"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                        >
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- View Mode -->
                            <div class="p-5">
                                <div class="flex items-center justify-between gap-x-4">
                                    <div class="flex items-center gap-x-4 flex-1">
                                        <!-- Color Circle -->
                                        <div class="shrink-0">
                                            <div
                                                class="size-10 rounded-full border border-gray-200 dark:border-neutral-700"
                                                style="background-color: {{ $category->color_code }};"
                                            ></div>
                                        </div>

                                        <!-- Color Code -->
                                        <div class="min-w-[100px]">
                                            <span class="text-sm font-mono text-gray-600 dark:text-neutral-400">
                                                {{ $category->color_code }}
                                            </span>
                                        </div>

                                        <!-- Category Name -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $category->name }}
                                            </h3>
                                        </div>

                                        <!-- Status Badge -->
                                        <div>
                                            @if($category->is_active)
                                                <span class="inline-flex items-center gap-x-1 py-1 px-2.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500">
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-x-1 py-1 px-2.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-500/10 dark:text-gray-500">
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-x-3">
                                        <button
                                            type="button"
                                            wire:click="editCategory({{ $category->id }})"
                                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium dark:text-indigo-500 dark:hover:text-indigo-400"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            type="button"
                                            wire:click="deleteCategory({{ $category->id }})"
                                            wire:confirm="Are you sure you want to delete this category?"
                                            class="text-sm text-red-600 hover:text-red-800 font-medium dark:text-red-500 dark:hover:text-red-400"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-10 text-center dark:bg-neutral-800 dark:border-neutral-700">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                <p class="mt-4 text-gray-600 dark:text-neutral-400">No categories yet. Create your first category to get started.</p>
            </div>
        @endif
</div>
