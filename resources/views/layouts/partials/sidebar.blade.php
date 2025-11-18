<!-- Sidebar -->
<div id="hs-application-sidebar" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-[260px] h-full hidden fixed inset-y-0 start-0 z-[60] bg-white border-e border-gray-200 lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 dark:bg-neutral-800 dark:border-neutral-700">
    <div class="relative flex flex-col h-full max-h-full">
        <div class="px-6 pt-4">
            <a class="flex-none rounded-xl text-xl inline-block font-semibold" href="{{ route('workspace.dashboard') }}">
                <span class="text-blue-600">Insight</span><span class="text-gray-900">HQ</span>
            </a>
        </div>

        <div class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap">
                <ul class="flex flex-col space-y-1">
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 {{ request()->routeIs('workspace.dashboard') ? 'bg-gray-100' : '' }}" href="{{ route('workspace.dashboard') }}">
                            <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Dashboard
                        </a>
                    </li>

                    @php
                        $navigationItems = \App\Models\WorkspaceNavigationItem::where('workspace_id', Auth::user()->workspace->id)
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                            ->get();

                        $navigationIcons = [
                            'changelog' => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>',
                            'feedback' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
                            'roadmap' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m22 4-10 6"/><path d="m6 12-4-2"/>',
                            'testimonials' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>',
                            'knowledge_board' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
                            'research_repo' => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
                        ];

                        $navigationRoutes = [
                            'changelog' => 'changelog.index',
                            'feedback' => 'feedback.index',
                            'roadmap' => '#',
                            'testimonials' => 'testimonials.index',
                            'knowledge_board' => 'knowledge.index',
                            'research_repo' => 'research.index',
                        ];
                    @endphp

                    @foreach($navigationItems as $navItem)
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700" href="{{ $navigationRoutes[$navItem->key] !== '#' ? route($navigationRoutes[$navItem->key]) : '#' }}">
                                <svg class="shrink-0 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $navigationIcons[$navItem->key] ?? '<circle cx="12" cy="12" r="10"/>' !!}</svg>
                                {{ $navItem->label }}
                            </a>
                        </li>
                    @endforeach

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

                    <!-- App Settings Accordion -->
                    <li class="hs-accordion {{ request()->routeIs('settings.*') ? 'active' : '' }}" id="app-settings-accordion">
                        <button type="button" class="hs-accordion-toggle hs-accordion-active:bg-gray-100 w-full text-start flex gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:bg-neutral-700 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700" aria-expanded="{{ request()->routeIs('settings.*') ? 'true' : 'false' }}" aria-controls="app-settings-accordion-sub">
                            <svg class="shrink-0 mt-0.5 size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                            App Settings
                            <svg class="hs-accordion-active:-rotate-180 shrink-0 mt-1 size-3.5 ms-auto transition" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <div id="app-settings-accordion-sub" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="app-settings-accordion" style="{{ request()->routeIs('settings.*') ? 'display: block;' : 'display: none;' }}">
                            <ul class="hs-accordion-group ps-8 pt-1 flex flex-col gap-y-1 relative before:absolute before:top-0 before:start-[18px] before:w-0.5 before:h-full before:bg-gray-200 dark:before:bg-neutral-700" data-hs-accordion-always-open>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.general') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.general') }}">
                                        General
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.invite') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.invite') }}">
                                        Invite
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.script') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.script') }}">
                                        Script
                                        <span class="ms-auto inline-flex items-center gap-1.5 py-px px-1.5 rounded-sm text-[10px] leading-4 font-medium bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-300">Soon</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.status-workflow') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.status-workflow') }}">
                                        Status Workflow
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.topics-tags') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.topics-tags') }}">
                                        Topics & Tags
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.changelog') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.changelog') }}">
                                        Changelog
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.themes') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.themes') }}">
                                        Themes
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.plan') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.plan') }}">
                                        Plan
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.billing') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.billing') }}">
                                        Billing
                                    </a>
                                </li>
                                <li>
                                    <a class="flex gap-x-4 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 {{ request()->routeIs('settings.plans') ? 'bg-gray-100 dark:bg-neutral-700' : '' }}" href="{{ route('settings.plans') }}">
                                        Plans
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- End App Settings Accordion -->

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
