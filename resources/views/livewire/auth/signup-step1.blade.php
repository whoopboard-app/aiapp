<div>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" class="pb-23 sm:pb-16">
        <div class="py-10 lg:py-20 w-full max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="w-full max-w-sm mx-auto">
                <!-- Sign Up Form -->
                <div class="space-y-8">
                    <div class="text-center">
                        <h2 class="font-medium text-xl text-gray-800 dark:text-neutral-200">
                            Create your account
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Get started with InsightHQ
                        </p>
                    </div>

                    <form wire:submit.prevent="submitSignup" class="space-y-3">
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="sr-only">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                wire:model.defer="email"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('email') border-red-500 @enderror"
                                placeholder="you@company.com"
                                autofocus
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Email Input -->

                        <!-- Workspace Name -->
                        <div>
                            <label for="workspaceName" class="sr-only">
                                Workspace Name
                            </label>
                            <input
                                type="text"
                                id="workspaceName"
                                wire:model.defer="workspaceName"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('workspaceName') border-red-500 @enderror"
                                placeholder="Workspace name (e.g., Acme Inc.)"
                            >
                            @error('workspaceName')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Workspace Name -->

                        <!-- Password -->
                        <div>
                            <label for="password" class="sr-only">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    wire:model.defer="password"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 @error('password') border-red-500 @enderror"
                                    placeholder="Password"
                                >
                                <button type="button" data-hs-toggle-password='{
                                    "target": "#password"
                                }' class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-indigo-600 dark:text-neutral-600 dark:focus:text-indigo-500">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path class="hs-password-active:hidden" d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                                        <path class="hs-password-active:hidden" d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                                        <path class="hs-password-active:hidden" d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                                        <path class="hidden hs-password-active:block" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path class="hidden hs-password-active:block" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500 dark:text-neutral-400">Must be at least 8 characters</p>
                        </div>
                        <!-- End Password -->

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="sr-only">
                                Confirm Password
                            </label>
                            <input
                                id="password_confirmation"
                                type="password"
                                wire:model.defer="password_confirmation"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                                placeholder="Confirm password"
                            >
                        </div>
                        <!-- End Confirm Password -->

                        <div class="space-y-4 pt-2">
                            <button
                                type="submit"
                                class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 sm:text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading.remove>Create Account</span>
                                <span wire:loading>Creating Account...</span>
                            </button>

                            <a class="py-3 px-4 relative w-full inline-flex justify-center items-center gap-x-1.5 sm:text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300" href="{{ route('login') }}">
                                Already have an account? Log in
                            </a>

                            <!-- Terms Notice -->
                            <div class="text-xs text-center text-gray-500 dark:text-neutral-400">
                                By creating an account, you agree to our
                                <a href="#" class="text-indigo-600 underline-offset-4 hover:underline dark:text-indigo-400">Terms of Service</a>
                                and
                                <a href="#" class="text-indigo-600 underline-offset-4 hover:underline dark:text-indigo-400">Privacy Policy</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Sign Up Form -->
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
</div>
