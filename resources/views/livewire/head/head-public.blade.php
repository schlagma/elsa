<div class="flex h-16 shrink-0 items-center justify-items-end gap-x-4 border-b border-zinc-900 bg-zinc-800 px-4 shadow-xs shadow-black/20 sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-zinc-700 lg:hidden" @click="mobileMenu = true">
        <span class="sr-only">Open sidebar</span>
        @svg('mdi-menu', 'size-6 text-zinc-300 hover:text-zinc-100')
    </button>

    <livewire:dropdown.election-switch />
    <livewire:dropdown.language-switch />

    <button
        class="p-1 text-zinc-300 hover:text-zinc-100 cursor-pointer"
        title="{{ __('common.about') }} ELSA &hellip;"
        @click="dialogInfo = true"
    >
        <span aria-hidden="true">@svg('mdi-information', 'size-6')</span>
        <span class="sr-only">{{ __('common.about') }} ELSA &hellip;</span> 
    </button>
</div>
