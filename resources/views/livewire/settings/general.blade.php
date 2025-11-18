<div class="p-2 sm:p-5 sm:py-0 md:pt-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                General Settings
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                Manage your company settings.
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

        <!-- Company Branding Section -->
        <div class="mb-5 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-5 md:px-7 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                    Company Branding
                </h2>
            </div>
            <form wire:submit.prevent="updateBranding">
                <div class="p-5 md:p-7 space-y-5">
                    <!-- Display Name -->
                    <div>
                        <label for="displayName" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                            Display Name
                        </label>
                        <input
                            type="text"
                            id="displayName"
                            wire:model.defer="displayName"
                            class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('displayName') border-red-500 @enderror"
                        >
                        @error('displayName')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="companyName" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                            Company Name
                        </label>
                        <input
                            type="text"
                            id="companyName"
                            wire:model.defer="companyName"
                            class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('companyName') border-red-500 @enderror"
                        >
                        @error('companyName')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo Link URL -->
                    <div>
                        <label for="logoLinkUrl" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                            Logo Link URL
                        </label>
                        <input
                            type="url"
                            id="logoLinkUrl"
                            wire:model.defer="logoLinkUrl"
                            placeholder="https://example.com"
                            class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('logoLinkUrl') border-red-500 @enderror"
                        >
                        @error('logoLinkUrl')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Logo (Light Theme) -->
                    <div>
                        <label for="logoLight" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                            Company Logo (Light Theme)
                        </label>
                        <p class="text-xs text-gray-500 mb-2">Recommended size: 256 x 256px</p>
                        @if($existingLogoLight)
                            <div class="mb-2">
                                <img src="{{ Storage::url($existingLogoLight) }}" alt="Current Logo" class="h-16 w-16 object-contain border border-gray-200 rounded p-1">
                            </div>
                        @endif
                        <input
                            type="file"
                            id="logoLight"
                            wire:model="logoLight"
                            accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                        >
                        @error('logoLight')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div wire:loading wire:target="logoLight" class="mt-2 text-sm text-gray-500">Uploading...</div>
                    </div>

                    <!-- Favicon Icon Upload -->
                    <div>
                        <label for="favicon" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                            Favicon Icon Upload
                        </label>
                        <p class="text-xs text-gray-500 mb-2">Recommended size: 96x96 (PNG only)</p>
                        @if($existingFavicon)
                            <div class="mb-2">
                                <img src="{{ Storage::url($existingFavicon) }}" alt="Current Favicon" class="h-8 w-8 object-contain border border-gray-200 rounded p-1">
                            </div>
                        @endif
                        <input
                            type="file"
                            id="favicon"
                            wire:model="favicon"
                            accept=".png"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                        >
                        @error('favicon')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div wire:loading wire:target="favicon" class="mt-2 text-sm text-gray-500">Uploading...</div>
                    </div>

                    <!-- Logo Uploads Section -->
                    <div class="border-t border-gray-200 pt-5 dark:border-neutral-700">
                        <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-200 mb-4">Logo Layout Variants</h3>

                        <!-- Square Layout -->
                        <div class="mb-5">
                            <label for="logoSquare" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Square Layout
                            </label>
                            <p class="text-xs text-gray-500 mb-2">Recommended size: 400 x 80px</p>
                            @if($existingLogoSquare)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($existingLogoSquare) }}" alt="Square Logo" class="h-16 object-contain border border-gray-200 rounded p-2">
                                </div>
                            @endif
                            <input
                                type="file"
                                id="logoSquare"
                                wire:model="logoSquare"
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            >
                            @error('logoSquare')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="logoSquare" class="mt-2 text-sm text-gray-500">Uploading...</div>
                        </div>

                        <!-- Landscape Layout -->
                        <div class="mb-5">
                            <label for="logoLandscape" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Landscape Layout
                            </label>
                            <p class="text-xs text-gray-500 mb-2">Recommended size: 256 x 256px</p>
                            @if($existingLogoLandscape)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($existingLogoLandscape) }}" alt="Landscape Logo" class="h-16 object-contain border border-gray-200 rounded p-2">
                                </div>
                            @endif
                            <input
                                type="file"
                                id="logoLandscape"
                                wire:model="logoLandscape"
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            >
                            @error('logoLandscape')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="logoLandscape" class="mt-2 text-sm text-gray-500">Uploading...</div>
                        </div>

                        <!-- Default Logo Layout Toggle -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Default Logo Layout
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.defer="defaultLogoLayout" value="square" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-indigo-600 focus:ring-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-indigo-500 dark:checked:border-indigo-500 dark:focus:ring-offset-gray-800">
                                    <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Square</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.defer="defaultLogoLayout" value="landscape" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-indigo-600 focus:ring-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-indigo-500 dark:checked:border-indigo-500 dark:focus:ring-offset-gray-800">
                                    <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Landscape</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex justify-end items-center gap-x-2 py-3 px-5 md:px-7 border-t border-gray-200 dark:border-neutral-700">
                    <button
                        type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove wire:target="updateBranding">Update</span>
                        <span wire:loading wire:target="updateBranding">Updating...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Site Navigations Section -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-5 md:px-7 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                    Site Navigations
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                    Customize which sections are visible to your users and the order they appear.
                </p>
            </div>
            <form wire:submit.prevent="updateNavigations">
                <div class="p-5 md:p-7">
                    <!-- Navigation Items List -->
                    <div class="space-y-3">
                        @foreach($navigationItems as $index => $item)
                            <div class="flex items-center gap-x-4 p-4 bg-gray-50 border border-gray-200 rounded-lg dark:bg-neutral-800/50 dark:border-neutral-700">
                                <!-- Reorder Buttons -->
                                <div class="flex flex-col gap-y-1">
                                    <button
                                        type="button"
                                        wire:click="moveUp({{ $index }})"
                                        @if($index === 0) disabled @endif
                                        class="p-1 inline-flex justify-center items-center text-gray-500 hover:bg-white hover:text-gray-800 rounded disabled:opacity-30 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-200 transition-colors"
                                    >
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                    </button>
                                    <button
                                        type="button"
                                        wire:click="moveDown({{ $index }})"
                                        @if($index === count($navigationItems) - 1) disabled @endif
                                        class="p-1 inline-flex justify-center items-center text-gray-500 hover:bg-white hover:text-gray-800 rounded disabled:opacity-30 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-200 transition-colors"
                                    >
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                </div>

                                <!-- Menu Name (Editable) -->
                                <div class="flex-1">
                                    @if($editingItemId === $item['id'])
                                        <div class="flex items-center gap-x-2">
                                            <input
                                                type="text"
                                                wire:model.defer="editingLabel"
                                                wire:keydown.enter="saveLabel({{ $index }})"
                                                wire:keydown.escape="cancelEditing"
                                                class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200"
                                                autofocus
                                            >
                                            <button
                                                type="button"
                                                wire:click="saveLabel({{ $index }})"
                                                class="py-2 px-3 inline-flex items-center text-xs font-semibold rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-hidden focus:bg-indigo-700"
                                            >
                                                Save
                                            </button>
                                            <button
                                                type="button"
                                                wire:click="cancelEditing"
                                                class="py-2 px-3 inline-flex items-center text-xs font-semibold rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    @else
                                        <button
                                            type="button"
                                            wire:click="startEditingLabel({{ $index }})"
                                            class="text-sm font-medium text-gray-800 hover:text-indigo-600 dark:text-neutral-200 dark:hover:text-indigo-400 transition-colors"
                                        >
                                            {{ $item['label'] }}
                                        </button>
                                    @endif
                                </div>

                                <!-- Active/Inactive Toggle Switch -->
                                <div class="flex items-center gap-x-3">
                                    <span class="text-sm text-gray-600 dark:text-neutral-400">
                                        {{ $item['is_active'] ? 'Active' : 'Inactive' }}
                                    </span>
                                    <input
                                        type="checkbox"
                                        wire:click="toggleNavigationItem({{ $index }})"
                                        @if($item['is_active']) checked @endif
                                        class="relative w-11 h-6 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-indigo-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-indigo-600 checked:border-indigo-600 focus:checked:border-indigo-600 dark:bg-neutral-700 dark:border-neutral-700 dark:checked:bg-indigo-500 dark:checked:border-indigo-500 dark:focus:ring-offset-gray-800 before:inline-block before:size-5 before:bg-white checked:before:bg-indigo-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-indigo-200"
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex justify-end items-center gap-x-2 py-3 px-5 md:px-7 border-t border-gray-200 dark:border-neutral-700">
                    <button
                        type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove wire:target="updateNavigations">Update</span>
                        <span wire:loading wire:target="updateNavigations">Updating...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
