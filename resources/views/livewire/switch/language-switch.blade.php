<div x-data="{ languageDropdown: false }" class="ml-2">
    <div class="relative">
        <div>
            <button type="button" aria-haspopup="menu" aria-expanded="false"
                class="-m-1.5 flex items-center py-1.5 pl-1 pr-2 text-zinc-300 hover:text-zinc-100 cursor-pointer"
                @click="languageDropdown = true">
                <span class="sr-only">Open language menu</span>
                <span class="flex items-center">
                    <span aria-hidden="true">@svg('mdi-translate', 'size-6')</span>
                    <span x-show="languageDropdown" aria-hidden="true">@svg('mdi-chevron-up', 'ml-2 h-5 w-5 text-zinc-300')</span>
                    <span x-show="!languageDropdown" aria-hidden="true">@svg('mdi-chevron-down', 'ml-2 h-5 w-5 text-zinc-300')</span>
                </span>
            </button>
        </div>
        <div class="absolute right-0 z-10 mt-4 w-44 origin-top-right divide-y divide-zinc-200 dark:divide-zinc-700 rounded-md bg-white dark:bg-zinc-800 ring-1 shadow-lg ring-black/5 dark:ring-zinc-700 focus:outline-hidden"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="menu-button"
            tabindex="-1"
            x-show="languageDropdown"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            @click.outside="languageDropdown = false"
        >
            <div class="py-1" role="none">
                @foreach(config('app.locales') as $key => $locale)
                <a
                    wire:navigate
                    href="{{ route('language', ['language' => $key]) }}"
                    class="group flex w-full items-center px-4 py-2 text-zinc-800 dark:text-white cursor-pointer hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:bg-zinc-200 dark:focus:bg-zinc-700 border-b-0! {{ app()->getLocale() === $key ? 'bg-zinc-300 hover:bg-zinc-300 dark:bg-zinc-600 dark:hover:bg-zinc-700' : '' }}"
                    role="menuitem"
                >
                    <span aria-hidden="true" class="mr-2">
                        <x-icon name="flag-language-{{ $key }}" class="size-6" />
                    </span>
                    {{ $locale['name'] }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>