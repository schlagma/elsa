<div class="grid grid-rows-[auto_1fr] w-full h-screen bg-zinc-100 dark:bg-zinc-800">
    <a class="flex h-16 px-6 shrink-0 items-center bg-zinc-800 border-b border-zinc-900 shadow-xs shadow-black/20" href="/admin">
        @if (file_exists(public_path('logo.svg')))
            <img class="h-8 w-auto" src="{{ asset('logo.svg') }}" alt="ELSA-Logo">
        @else
            <span class="mx-auto text-white text-xl">ELSA</span>
        @endif
    </a>
    <nav class="flex flex-1 flex-col px-6 py-4 h-full overflow-y-auto border-r border-zinc-300 dark:border-zinc-900">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/elections'))
                            <a wire:navigate href="{{ route('admin-elections-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-elections-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-ballot', 'size-6')</span>
                            {{ __('admin.elections') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/committees'))
                            <a wire:navigate href="{{ route('admin-committees-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-committees-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-account-group', 'size-6')</span>
                            {{ __('admin.committees') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/lists'))
                            <a wire:navigate href="{{ route('admin-lists-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-lists-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-list-box', 'size-6')</span>
                            {{ __('admin.lists') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/courses'))
                            <a wire:navigate href="{{ route('admin-courses-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-courses-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-school', 'size-6')</span>
                            {{ __('admin.courses') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/faculties'))
                            <a wire:navigate href="{{ route('admin-faculties-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-faculties-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-office-building', 'size-6')</span>
                            {{ __('admin.faculties') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/questions'))
                            <a wire:navigate href="{{ route('admin-questions-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-questions-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-comment-question', 'size-6')</span>
                            {{ __('admin.questions') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/candidates'))
                            <a wire:navigate href="{{ route('admin-candidates-index') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-candidates-index') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-account', 'size-6')</span>
                            {{ __('admin.candidates') }}
                        </a>
                    </li>

                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/results'))
                            <a wire:navigate href="/admin/results" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="/admin/results" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-receipt-text-check', 'size-6')</span>
                            {{ __('admin.results') }}
                        </a>
                    </li>
                </ul>
            </li>
            @can('admin')
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <li>
                        @if(str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/legal-texts'))
                            <a wire:navigate href="{{ route('admin-legal-texts-edit') }}" class="sidebar-nav-button active">
                        @else
                            <a wire:navigate href="{{ route('admin-legal-texts-edit') }}" class="sidebar-nav-button">
                        @endif
                            <span aria-hidden="true">@svg('mdi-scale-balance', 'size-6')</span>
                            {{ __('admin.legalTexts') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </nav>
</div>