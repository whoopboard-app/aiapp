<div>
    <div class="bg-white rounded-lg shadow-sm p-8">
        @if($tokenValid)
            <!-- Step 2: Workspace & Password Setup -->
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900">Complete your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Email verified: <strong class="text-green-600">{{ $email }}</strong>
                    </p>
                </div>

                <form wire:submit="completeSignup" class="space-y-4">
                    <!-- Workspace Name -->
                    <div>
                        <label for="workspaceName" class="block text-sm font-medium text-gray-700 mb-2">
                            Workspace Name
                            <span class="text-gray-500 font-normal">(Your business or team name)</span>
                        </label>
                        <input 
                            type="text" 
                            id="workspaceName"
                            wire:model="workspaceName"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('workspaceName') border-red-500 @enderror"
                            placeholder="Acme Inc."
                            autofocus
                        >
                        @error('workspaceName')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password"
                            wire:model="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">Must be at least 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation"
                            wire:model="password_confirmation"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="••••••••"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Create Account</span>
                        <span wire:loading>Creating Account...</span>
                    </button>
                </form>

                <!-- Terms Notice -->
                <div class="text-xs text-center text-gray-500">
                    By creating an account, you agree to our
                    <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a>
                    and
                    <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
                </div>
            </div>
        @else
            <!-- Error State -->
            <div class="text-center space-y-6">
                <!-- Error Icon -->
                <div class="flex justify-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Verification Failed</h2>
                    <p class="mt-2 text-sm text-gray-600">{{ $errorMessage }}</p>
                </div>

                <a 
                    href="{{ route('signup') }}" 
                    class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                >
                    Request New Verification Link
                </a>
            </div>
        @endif
    </div>
</div>
