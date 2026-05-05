<flux:navbar class="flex h-[4rem] shrink-0 items-center gap-x-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800 px-4 sm:gap-x-6 sm:px-6 lg:px-8 z-10 print:hidden">
    <div class="hidden md:inline w-[18rem]! -ml-6 lg:-ml-8">
        <flux:sidebar.header class="flex h-[4rem] shrink-0 items-center bg-zinc-100 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700">
            <a wire:navigate href="/" class="h-full flex flex-1 items-center justify-start lg:justify-center px-6">
                @if(file_exists(public_path('logo.svg')) && file_exists(public_path('logo-small.svg')))
                    <img class="h-8 w-auto hidden lg:inline" src="{{ asset('logo.svg') }}" alt="{{ config('app.name') }}">
                    <img class="h-8 w-auto lg:hidden" src="{{ asset('logo-small.svg') }}" alt="{{ config('app.name') }}">
                @else
                    <span class="text-zinc-800 dark:text-white text-xl font-semibold">{{ config('app.name') }}</span>
                @endif
            </a>
        </flux:sidebar.header>
    </div>
        
    <div class="flex items-center gap-x-2 ml-auto">
        <livewire:dropdown.language-switch />

        <flux:dropdown>
            @auth
                <flux:profile :chevron="false" avatar:name="{{ auth()->user()->name }}" />
            @else
                <flux:profile :chevron="false" avatar:name="?" />
            @endauth

            <flux:navmenu class="w-64">
                @auth
                    <div class="px-2 py-1.5" role="none">
                        <p class="truncate text-zinc-800 dark:text-white font-semibold" role="none">{{ auth()->user()->name }}</p>
                        @can('admin', Auth::user())
                            <p class="text-sm text-zinc-500 dark:text-zinc-400" role="none">{{ __('roles.admin') }}</p>
                        @else
                            <p class="text-sm text-zinc-500 dark:text-zinc-400" role="none">{{ __('roles.user') }}</p>
                        @endcan
                    </div>
                    <flux:navmenu.separator />
                @endauth
                
                @include('components.info')

                <flux:navmenu.separator />

                <flux:navmenu.item wire:navigate href="{{ route('imprint') }}">{{ __('common.imprint') }}</flux:navmenu.item>
                <flux:navmenu.item wire:navigate href="{{ route('privacy') }}">{{ __('common.privacyPolicy') }}</flux:navmenu.item>
                <flux:navmenu.item wire:navigate href="{{ route('accessibility') }}">{{ __('common.accessibility') }}</flux:navmenu.item>

                <flux:navmenu.separator />

                @guest
                    <flux:navmenu.item
                        icon="log-in"
                        href="/auth/login"
                    >
                        {{ __('common.login') }}
                    </flux:navmenu.item>
                @endguest
                @auth
                    <flux:navmenu.item
                        icon="log-out"
                        href="/auth/logout"
                    >
                        {{ __('common.logout') }}
                    </flux:navmenu.item>
                @endauth
            </flux:navmenu>
        </flux:dropdown>
    </div>
</flux:navbar>