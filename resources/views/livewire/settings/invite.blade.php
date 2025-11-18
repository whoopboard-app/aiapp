<div class="p-2 sm:p-5 sm:py-0 md:pt-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Invite Team
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                Add members to your company to help manage ideas.
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
                            <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Status</th>
                            <th scope="col" class="px-5 md:px-7 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Last Active</th>
                            <th scope="col" class="px-5 md:px-7 py-3 text-end text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach($members as $member)
                            <tr>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-x-3">
                                        @if($member->profile_image)
                                            <img class="size-8 rounded-full object-cover" src="{{ Storage::url($member->profile_image) }}" alt="{{ $member->name }}">
                                        @else
                                            <img class="size-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=4f46e5&color=fff&size=128" alt="{{ $member->name }}">
                                        @endif
                                        <span class="text-gray-800 dark:text-neutral-200">{{ $member->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $member->email }}
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-x-2">
                                        @php
                                            $roleColors = [
                                                'owner' => 'bg-purple-100 text-purple-800 dark:bg-purple-500/10 dark:text-purple-500',
                                                'admin' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-500',
                                                'viewer' => 'bg-gray-100 text-gray-800 dark:bg-gray-500/10 dark:text-gray-500',
                                                'read_only' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-500',
                                            ];
                                            $roleColor = $roleColors[$member->role] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs font-medium {{ $roleColor }}">
                                            {{ ucfirst(str_replace('_', ' ', $member->role ?? 'viewer')) }}
                                        </span>
                                        @if($member->role === 'owner')
                                            <span class="inline-flex items-center gap-x-1 py-0.5 px-2 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-500/10 dark:text-indigo-500">
                                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                                Owner
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm">
                                    <div class="flex flex-col gap-y-1">
                                        @if($member->is_active)
                                            <span class="inline-flex items-center gap-x-1 py-0.5 px-2 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500 w-fit">
                                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-x-1 py-0.5 px-2 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500 w-fit">
                                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                                                Inactive
                                            </span>
                                        @endif
                                        @if(!$member->can_login)
                                            <span class="inline-flex items-center gap-x-1 py-0.5 px-2 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-500/10 dark:text-orange-500 w-fit">
                                                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                                Login Disabled
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $member->last_active_at ? $member->last_active_at->diffForHumans() : 'Never' }}
                                </td>
                                <td class="px-5 md:px-7 py-4 whitespace-nowrap text-sm text-end">
                                    <button
                                        type="button"
                                        wire:click="editMember({{ $member->id }})"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium dark:text-indigo-500 dark:hover:text-indigo-400"
                                    >
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Member Modal -->
        @if($editingMemberId)
            <!-- Backdrop -->
            <div class="fixed inset-0 z-[60] bg-gray-900 bg-opacity-50 dark:bg-opacity-80 dark:bg-neutral-900" wire:click="cancelEdit"></div>

            <!-- Modal -->
            <div class="fixed top-0 start-0 z-[70] w-full h-full overflow-x-hidden overflow-y-auto flex items-center justify-center p-4">
                <div class="w-full max-w-lg bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                        <h3 class="font-semibold text-gray-800 dark:text-white">
                            Edit Team Member
                        </h3>
                        <button type="button" wire:click="cancelEdit" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-4 space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="editMemberName" class="block text-sm font-medium mb-2 dark:text-white">
                                Name
                            </label>
                            <input
                                type="text"
                                id="editMemberName"
                                wire:model.defer="editMemberName"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('editMemberName') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            >
                            @error('editMemberName')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (Readonly) -->
                        <div>
                            <label for="editMemberEmail" class="block text-sm font-medium mb-2 dark:text-white">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="editMemberEmail"
                                wire:model="editMemberEmail"
                                readonly
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-500 cursor-not-allowed dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-500"
                            >
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="editMemberRole" class="block text-sm font-medium mb-2 dark:text-white">
                                Role
                            </label>
                            <select
                                id="editMemberRole"
                                wire:model.defer="editMemberRole"
                                class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('editMemberRole') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            >
                                @foreach($roles as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('editMemberRole')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Toggle -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg dark:border-neutral-700">
                            <div>
                                <label class="block text-sm font-medium dark:text-white">
                                    Account Status
                                </label>
                                <p class="text-xs text-gray-500 dark:text-neutral-400 mt-1">
                                    {{ $editMemberIsActive ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                            <input
                                type="checkbox"
                                wire:model.defer="editMemberIsActive"
                                class="relative w-11 h-6 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-indigo-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-indigo-600 checked:border-indigo-600 focus:checked:border-indigo-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-indigo-500 dark:checked:border-indigo-500 dark:focus:ring-offset-neutral-900 before:inline-block before:size-5 before:bg-white checked:before:bg-indigo-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-indigo-200"
                            >
                        </div>

                        <!-- Login Access Toggle -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg dark:border-neutral-700">
                            <div>
                                <label class="block text-sm font-medium dark:text-white">
                                    Login Access
                                </label>
                                <p class="text-xs text-gray-500 dark:text-neutral-400 mt-1">
                                    {{ $editMemberCanLogin ? 'Enabled' : 'Disabled' }}
                                </p>
                            </div>
                            <input
                                type="checkbox"
                                wire:model.defer="editMemberCanLogin"
                                class="relative w-11 h-6 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-indigo-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-indigo-600 checked:border-indigo-600 focus:checked:border-indigo-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-indigo-500 dark:checked:border-indigo-500 dark:focus:ring-offset-neutral-900 before:inline-block before:size-5 before:bg-white checked:before:bg-indigo-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-indigo-200"
                            >
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                        <button
                            type="button"
                            wire:click="cancelEdit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            wire:click="updateMember"
                            wire:loading.attr="disabled"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none"
                        >
                            <span wire:loading.remove wire:target="updateMember">Update Member</span>
                            <span wire:loading wire:target="updateMember">
                                <svg class="animate-spin inline-block size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Updating...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
