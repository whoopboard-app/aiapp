<div>
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                <span class="text-2xl">🏢</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Tell us about your workspace
            </h1>
            <p class="text-lg text-gray-600">
                Help us personalize your experience
            </p>
        </div>

        <!-- Progress Indicator -->
        <div class="mb-8">
            <div class="flex items-center justify-center space-x-2">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-green-600">Goals</span>
                </div>
                <div class="w-12 h-0.5 bg-blue-600"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-blue-600">Workspace Info</span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-6">
            <form wire:submit="save" class="space-y-6">
                <!-- Workspace Name -->
                <div>
                    <label for="workspaceName" class="block text-sm font-medium text-gray-700 mb-2">
                        Workspace Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="workspaceName"
                        wire:model="workspaceName"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('workspaceName') border-red-500 @enderror"
                        placeholder="Acme Inc."
                        maxlength="100"
                        autofocus
                    >
                    @error('workspaceName')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">
                        This is your company or team name. You can change this later.
                    </p>
                </div>

                <!-- Website URL -->
                <div>
                    <label for="websiteUrl" class="block text-sm font-medium text-gray-700 mb-2">
                        Website URL <span class="text-gray-400">(Optional)</span>
                    </label>
                    <input 
                        type="url" 
                        id="websiteUrl"
                        wire:model="websiteUrl"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('websiteUrl') border-red-500 @enderror"
                        placeholder="https://example.com"
                    >
                    @error('websiteUrl')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">
                        Your company website. Must start with http:// or https://
                    </p>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800">
                                <strong class="font-semibold">Note:</strong> Custom subdomains and public URLs are not available in Phase 1. This information is for internal use only and will be used in future features.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Complete Setup</span>
                    <span wire:loading>Saving...</span>
                </button>
            </form>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between text-sm">
            <button
                type="button"
                wire:click="back"
                class="text-gray-600 hover:text-gray-900 font-medium flex items-center"
            >
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </button>

            <button
                type="button"
                wire:click="skip"
                class="text-gray-600 hover:text-gray-900 font-medium"
            >
                Skip for now
            </button>
        </div>
    </div>
</div>
