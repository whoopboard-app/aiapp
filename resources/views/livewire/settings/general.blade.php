<x-app-layout>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                General Settings
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                Manage your workspace general settings and preferences
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

        <!-- Settings Form Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <form wire:submit.prevent="save">
                <div class="p-5 md:p-7 space-y-5">
                    <!-- Workspace Name -->
                    <div>
                        <label for="workspaceName" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                            Workspace Name
                        </label>
                        <input
                            type="text"
                            id="workspaceName"
                            wire:model.defer="workspaceName"
                            class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('workspaceName') border-red-500 @enderror"
                        >
                        @error('workspaceName')
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

                    <!-- Website URL -->
                    <div>
                            <label for="websiteUrl" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Website URL
                            </label>
                            <input
                                type="url"
                                id="websiteUrl"
                                wire:model.defer="websiteUrl"
                                placeholder="https://example.com"
                                class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('websiteUrl') border-red-500 @enderror"
                            >
                            @error('websiteUrl')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>

                    <!-- Support Email -->
                    <div>
                            <label for="supportEmail" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Support Email
                            </label>
                            <input
                                type="email"
                                id="supportEmail"
                                wire:model.defer="supportEmail"
                                placeholder="support@example.com"
                                class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('supportEmail') border-red-500 @enderror"
                            >
                            @error('supportEmail')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>

                    <!-- Timezone -->
                    <div>
                            <label for="timezone" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Timezone
                            </label>
                            <select
                                id="timezone"
                                wire:model.defer="timezone"
                                class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('timezone') border-red-500 @enderror"
                            >
                                @foreach($timezones as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('timezone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>

                    <!-- Date Format -->
                    <div>
                            <label for="dateFormat" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Date Format
                            </label>
                            <select
                                id="dateFormat"
                                wire:model.defer="dateFormat"
                                class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('dateFormat') border-red-500 @enderror"
                            >
                                @foreach($dateFormats as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('dateFormat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>

                    <!-- Time Format -->
                    <div>
                            <label for="timeFormat" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Time Format
                            </label>
                            <select
                                id="timeFormat"
                                wire:model.defer="timeFormat"
                                class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('timeFormat') border-red-500 @enderror"
                            >
                                @foreach($timeFormats as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('timeFormat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                    </div>
            </div>

                <!-- Form Footer -->
                <div class="flex justify-end items-center gap-x-2 py-3 px-5 md:px-7 border-t border-gray-200 dark:border-neutral-700">
                    <button
                        type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Save Changes</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
