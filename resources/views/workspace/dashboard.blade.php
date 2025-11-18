<x-app-layout>
    <div class="mb-5">
        <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-600">Welcome to {{ auth()->user()->workspace->name }}</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5">
                <p class="text-xs uppercase tracking-wide text-gray-500">Total Feedback</p>
                <h3 class="text-xl sm:text-2xl font-medium text-gray-800 mt-1">0</h3>
            </div>
        </div>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5">
                <p class="text-xs uppercase tracking-wide text-gray-500">Changelog Entries</p>
                <h3 class="text-xl sm:text-2xl font-medium text-gray-800 mt-1">0</h3>
            </div>
        </div>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5">
                <p class="text-xs uppercase tracking-wide text-gray-500">Knowledge Articles</p>
                <h3 class="text-xl sm:text-2xl font-medium text-gray-800 mt-1">0</h3>
            </div>
        </div>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="p-4 md:p-5">
                <p class="text-xs uppercase tracking-wide text-gray-500">Team Members</p>
                <h3 class="text-xl sm:text-2xl font-medium text-gray-800 mt-1">1</h3>
            </div>
        </div>
    </div>
</x-app-layout>
