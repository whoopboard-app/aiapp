<div>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" class="pb-23 sm:pb-16">
        <div class="py-10 lg:py-20 w-full max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="w-full max-w-md mx-auto">
                @if($errorMessage)
                    <!-- Error State -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
                        <div class="p-6 sm:p-10">
                            <div class="flex justify-center mb-6">
                                <div class="inline-flex items-center justify-center size-16 bg-red-100 rounded-full dark:bg-red-500/10">
                                    <svg class="shrink-0 size-8 text-red-600 dark:text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" x2="9" y1="9" y2="15"/>
                                        <line x1="9" x2="15" y1="9" y2="15"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="block text-2xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Invalid Invitation
                                </h1>
                                <p class="mt-3 text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $errorMessage }}
                                </p>
                                <div class="mt-6">
                                    <a href="{{ route('login') }}" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-hidden focus:bg-indigo-700">
                                        Go to Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Sign Up Form -->
                    <div class="space-y-8">
                        <div class="text-center">
                            <h2 class="font-medium text-xl text-gray-800 dark:text-neutral-200">
                                Complete your profile
                            </h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                Join {{ $invitation->workspace->name }} workspace
                            </p>
                        </div>

                        <form wire:submit.prevent="completeSignup" class="space-y-4">
                            <!-- First Name -->
                            <div>
                                <label for="firstName" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    First Name <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="firstName"
                                    type="text"
                                    wire:model.defer="firstName"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('firstName') border-red-500 @enderror"
                                    placeholder="John"
                                    autofocus
                                >
                                @error('firstName')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="lastName" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Last Name <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="lastName"
                                    type="text"
                                    wire:model.defer="lastName"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('lastName') border-red-500 @enderror"
                                    placeholder="Doe"
                                >
                                @error('lastName')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Address (Readonly) -->
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Email Address
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    wire:model="email"
                                    readonly
                                    class="py-3 px-4 block w-full bg-gray-50 border-gray-200 rounded-lg text-sm text-gray-500 cursor-not-allowed dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400"
                                >
                            </div>

                            <!-- Role (Readonly) -->
                            <div>
                                <label for="role" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Role
                                </label>
                                <input
                                    id="role"
                                    type="text"
                                    value="{{ ucfirst(str_replace('_', ' ', $role)) }}"
                                    readonly
                                    class="py-3 px-4 block w-full bg-gray-50 border-gray-200 rounded-lg text-sm text-gray-500 cursor-not-allowed dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400"
                                >
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Password <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="password"
                                    type="password"
                                    wire:model.defer="password"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('password') border-red-500 @enderror"
                                    placeholder="Enter password"
                                >
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Confirm Password <span class="text-red-600">*</span>
                                </label>
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    wire:model.defer="password_confirmation"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                                    placeholder="Confirm password"
                                >
                            </div>

                            <!-- Profile Image Upload (Optional) -->
                            <div>
                                <label for="profileImage" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Profile Image <span class="text-sm text-gray-500">(Optional)</span>
                                </label>
                                <p class="text-xs text-gray-500 mb-2">Auto-generated avatar will be created if not uploaded</p>

                                @if ($profileImage)
                                    <div class="mb-3 flex items-center gap-x-3">
                                        <img src="{{ $profileImage->temporaryUrl() }}" alt="Preview" class="size-16 rounded-full object-cover border-2 border-gray-200">
                                        <button type="button" wire:click="$set('profileImage', null)" class="text-sm text-red-600 hover:text-red-800">
                                            Remove
                                        </button>
                                    </div>
                                @endif

                                <input
                                    id="profileImage"
                                    type="file"
                                    wire:model="profileImage"
                                    accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-500/10 dark:file:text-indigo-500"
                                >
                                @error('profileImage')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div wire:loading wire:target="profileImage" class="mt-2 text-sm text-gray-500">Uploading...</div>
                            </div>

                            <!-- Timezone (Optional) -->
                            <div>
                                <label for="timezone" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                    Timezone <span class="text-sm text-gray-500">(Optional)</span>
                                </label>
                                <select
                                    id="timezone"
                                    wire:model.defer="timezone"
                                    class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:focus:ring-neutral-600"
                                >
                                    @foreach($timezones as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button
                                    type="submit"
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                                    wire:loading.attr="disabled"
                                >
                                    <span wire:loading.remove>Continue</span>
                                    <span wire:loading>Creating account...</span>
                                </button>
                            </div>
                        </form>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium dark:text-indigo-500 dark:hover:text-indigo-400">
                                    Sign in here
                                </a>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
</div>
