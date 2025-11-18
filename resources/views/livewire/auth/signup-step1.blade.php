<div>
    <div class="bg-white rounded-lg shadow-sm p-8">
        @if(!$emailSent)
            <!-- Step 1: Email Input -->
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900">Create your account</h2>
                    <p class="mt-2 text-sm text-gray-600">Enter your work email to get started</p>
                </div>

                <form wire:submit="submitEmail" class="space-y-4">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Work Email
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            wire:model="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                            placeholder="you@company.com"
                            autofocus
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Continue</span>
                        <span wire:loading>Sending...</span>
                    </button>
                </form>

                <!-- Login Link -->
                <div class="text-center text-sm">
                    <span class="text-gray-600">Already have an account?</span>
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Log in
                    </a>
                </div>
            </div>
        @else
            <!-- Email Sent Confirmation -->
            <div class="text-center space-y-6">
                <!-- Success Icon -->
                <div class="flex justify-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Check your email</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        We've sent a verification link to<br>
                        <strong class="text-gray-900">{{ $email }}</strong>
                    </p>
                </div>

                <div class="bg-blue-50 rounded-lg p-4 text-sm text-gray-700">
                    <p class="font-medium">What's next?</p>
                    <ol class="mt-2 space-y-1 list-decimal list-inside text-left">
                        <li>Open the email we sent you</li>
                        <li>Click the verification link</li>
                        <li>Complete your account setup</li>
                    </ol>
                </div>

                <!-- Resend Link -->
                <div class="text-sm text-gray-600">
                    Didn't receive the email?
                    <button 
                        wire:click="resendEmail"
                        class="font-medium text-blue-600 hover:text-blue-500"
                        wire:loading.attr="disabled"
                    >
                        Resend
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
