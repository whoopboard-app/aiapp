<x-app-layout>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Team Members
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                Invite team members and manage access to your workspace
            </p>
        </div>

        <!-- Invite Form Card -->
        <div class="mb-5 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-5 md:p-7">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-4">
                    Invite New Member
                </h3>

                <form wire:submit.prevent="sendInvite" class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="email"
                                wire:model.defer="email"
                                placeholder="colleague@example.com"
                                class="py-2 px-3 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">
                                Role
                            </label>
                            <select
                                id="role"
                                wire:model.defer="role"
                                class="py-2 px-3 pe-9 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-hidden focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600 @error('role') border-red-500 @enderror"
                            >
                                @foreach($roles as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-indigo-700"
                            wire:loading.attr="disabled"
                        >
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><path d="M22 2 15 22 11 13 2 9z"/></svg>
                            <span wire:loading.remove>Send Invitation</span>
                            <span wire:loading>Sending...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Pending Invitations -->
        @if($pendingInvitations->count() > 0)
            <div class="mb-5 bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
                <div class="px-5 md:px-7 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        Pending Invitations
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Email</th>
                                <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Role</th>
                                <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Invited</th>
                                <th scope="col" class="px-5 md:px-7 py-3 text-end text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach($pendingInvitations as $invitation)
                                <tr>
                                    <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $invitation->email }}
                                    </td>
                                    <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-500">
                                            {{ ucfirst($invitation->role) }}
                                        </span>
                                    </td>
                                    <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-neutral-400">
                                        {{ $invitation->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-end">
                                        <button
                                            type="button"
                                            wire:click="deleteInvitation({{ $invitation->id }})"
                                            wire:confirm="Are you sure you want to delete this invitation?"
                                            class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Team Members -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-5 md:px-7 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                    Team Members
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-800">
                        <tr>
                            <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Name</th>
                            <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Email</th>
                            <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Role</th>
                            <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Last Active</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach($members as $member)
                            <tr>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-x-3">
                                        <img class="size-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=4f46e5&color=fff&size=128" alt="{{ $member->name }}">
                                        <span class="text-gray-800 dark:text-neutral-200">{{ $member->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $member->email }}
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-500">
                                        {{ ucfirst($member->role ?? 'member') }}
                                    </span>
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $member->last_active_at ? $member->last_active_at->diffForHumans() : 'Never' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
