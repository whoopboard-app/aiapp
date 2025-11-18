<div>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                <span class="text-2xl">🎯</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                What's your main goal today?
            </h1>
            <p class="text-lg text-gray-600">
                Select all that apply. You can change these later in settings.
            </p>
        </div>

        <!-- Progress Indicator -->
        <div class="mb-8">
            <div class="flex items-center justify-center space-x-2">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">
                        1
                    </div>
                    <span class="ml-2 text-sm font-medium text-blue-600">Select Goals</span>
                </div>
                <div class="w-12 h-0.5 bg-gray-300"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Get Started</span>
                </div>
            </div>
        </div>

        <!-- Goals Grid -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            @error('selectedGoals')
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                </div>
            @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($goals as $goal)
                    <button
                        type="button"
                        wire:click="toggleGoal('{{ $goal->key }}')"
                        class="relative group text-left p-6 rounded-lg border-2 transition-all duration-200 hover:shadow-md
                            {{ $this->isSelected($goal->key) 
                                ? 'border-blue-600 bg-blue-50 shadow-sm' 
                                : 'border-gray-200 bg-white hover:border-blue-300' 
                            }}"
                    >
                        <!-- Selected Checkmark -->
                        <div class="absolute top-4 right-4">
                            @if($this->isSelected($goal->key))
                                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-6 h-6 border-2 border-gray-300 rounded-full group-hover:border-blue-400 transition-colors"></div>
                            @endif
                        </div>

                        <!-- Icon -->
                        <div class="text-4xl mb-3">
                            {{ $goal->icon }}
                        </div>

                        <!-- Title -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ $goal->name }}
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600">
                            {{ $goal->description }}
                        </p>
                    </button>
                @endforeach
            </div>

            <!-- Selection Count -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    <span class="font-semibold text-blue-600">{{ count($selectedGoals) }}</span>
                    {{ count($selectedGoals) === 1 ? 'goal' : 'goals' }} selected
                </p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <button
                type="button"
                wire:click="skip"
                class="text-sm text-gray-600 hover:text-gray-900 font-medium"
            >
                Skip for now
            </button>

            <button
                type="button"
                wire:click="continue"
                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Continue</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>

        <!-- Help Text -->
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500">
                Don't worry, you can always change your goals later in workspace settings.
            </p>
        </div>
    </div>
</div>
