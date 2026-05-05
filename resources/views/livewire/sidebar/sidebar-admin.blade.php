<div>
    <flux:sidebar collapsible="mobile" class="w-[18rem]! p-0! flex flex-col gap-0! h-full grow bg-zinc-100 dark:bg-zinc-800">
        <flux:sidebar.header class="flex h-[4rem] shrink-0 items-center bg-zinc-100 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700 border-r lg:border-r-0 border-r-zinc-300  dark:border-r-zinc-700 z-10">
            <a wire:navigate href="/" class="h-full flex flex-1 items-center justify-start lg:justify-center px-6">
                <span class="text-zinc-800 dark:text-white text-xl font-semibold">{{ config('app.name') }}</span>
            </a>
            <flux:sidebar.collapse class="mr-3 lg:hidden" />
        </flux:sidebar.header>

        <div class="grow overflow-y-auto border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.nav class="px-6 py-4">
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/elections')"
                    wire:navigate
                    href="{{ route('admin-elections-index') }}"
                    icon="vote"
                >
                    {{ __('admin.elections') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/committees')"
                    wire:navigate
                    href="{{ route('admin-committees-index') }}"
                    icon="users"
                >
                    {{ __('admin.committees') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/lists')"
                    wire:navigate
                    href="{{ route('admin-lists-index') }}"
                    icon="list"
                >
                    {{ __('admin.lists') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/courses')"
                    wire:navigate
                    href="{{ route('admin-courses-index') }}"
                    icon="graduation-cap"
                >
                    {{ __('admin.courses') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/faculties')"
                    wire:navigate
                    href="{{ route('admin-faculties-index') }}"
                    icon="building-2"
                >
                    {{ __('admin.faculties') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/questions')"
                    wire:navigate
                    href="{{ route('admin-questions-index') }}"
                    icon="message-circle-question-mark"
                >
                    {{ __('admin.questions') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/candidates')"
                    wire:navigate
                    href="{{ route('admin-candidates-index') }}"
                    icon="user"
                >
                    {{ __('admin.candidates') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/results')"
                    wire:navigate
                    href="{{ route('admin-results-index') }}"
                    icon="clipboard-check"
                >
                    {{ __('admin.results') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            @can('admin')
                <flux:sidebar.nav class="px-6 py-4">
                    <flux:sidebar.item
                        :current="str_contains(Route::getFacadeRoot()->current()->uri(), 'admin/legal-texts')"
                        wire:navigate
                        href="{{ route('admin-legal-texts-edit') }}"
                        icon="scale"
                    >
                        {{ __('admin.legalTexts') }}
                    </flux:sidebar.item>
                </flux:sidebar.nav>
            @endcan
        </div>
    </flux:sidebar>
</div>