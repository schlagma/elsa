<div class="flex h-16 shrink-0 items-center justify-items-end gap-x-4 border-b border-zinc-900 bg-zinc-800 px-4 shadow-sm shadow-black/20 sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-zinc-700 lg:hidden" @click="mobileMenu = true">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <livewire:switch.election-switch />
    <livewire:switch.language-switch />

    <button
        class="-m-2.5 p-2.5 text-zinc-300 hover:text-zinc-100 cursor-pointer"
        title="{{ __('common.about') }} ELSA &hellip;"
        @click="dialogInfo = true"
    >
        <span aria-hidden="true">@svg('mdi-information', 'size-6')</span>
        <span class="sr-only">{{ __('common.about') }} ELSA &hellip;</span> 
    </button>
</div>
