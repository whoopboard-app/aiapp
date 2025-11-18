<!-- Sidebar -->
<div id="hs-application-sidebar" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-[260px] h-full hidden fixed inset-y-0 start-0 z-[60] bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 dark:bg-neutral-800 dark:border-neutral-700">
    <div class="relative flex flex-col h-full max-h-full">
        <div class="px-6 pt-4">
            <a class="flex-none rounded-xl text-xl inline-block font-semibold" href="{{ route('workspace.dashboard') }}">
                <span class="text-blue-600">Insight</span><span class="text-gray-900">HQ</span>
            </a>
        </div>

        <div class="h-full overflow-y-auto">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap">
                <ul class="flex flex-col space-y-1">
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 {{ request()->routeIs('workspace.dashboard') ? 'bg-gray-100' : '' }}" href="{{ route('workspace.dashboard') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('changelog.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/></svg>
                            Changelog
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('feedback.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Feedback
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="#">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/></svg>
                            Roadmap
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('testimonials.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            Testimonials
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('knowledge.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/></svg>
                            Knowledge Board
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('research.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            Research Repo
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="#">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/></svg>
                            Subscribe List
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="#">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="7" height="7" x="3" y="3" rx="1"/></svg>
                            Segmentations
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('personas.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="10" r="4"/></svg>
                            Personas
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('journey.index') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            Journey Mapping
                        </a>
                    </li>

                    <li class="pt-4 mt-4 border-t border-gray-200">
                        <span class="block px-2.5 py-2 text-xs font-semibold uppercase text-gray-500">Settings</span>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="#">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><line x1="19" x2="19" y1="8" y2="14"/></svg>
                            Invite Team Member
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="{{ route('workspace.settings') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/></svg>
                            App Settings
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="#" target="_blank">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                            View Your Website
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100" href="#">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/></svg>
                            Your Widget
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                                Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
