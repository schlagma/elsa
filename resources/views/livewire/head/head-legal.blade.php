<div class="flex h-16 shrink-0 items-center gap-x-4 border-b border-zinc-900 bg-zinc-800 pr-4 shadow-xs shadow-black/30 sm:gap-x-6 sm:pr-6 lg:pr-8 z-10 print:hidden">
    <a wire:navigate href="/" class="flex h-full items-center border-b-0 sm:w-[18rem] px-6">
        <img class="h-8 w-auto hidden sm:inline" src="{{ asset('logo.svg') }}" alt="{{ config('app.name') }}">
        <img class="h-8 w-auto sm:hidden" src="{{ asset('logo-small.svg') }}" alt="{{ config('app.name') }}">
    </a>
    
    <div class="flex items-center gap-x-6 ml-auto">
        <livewire:dropdown.language-switch />
        <button
            class="p-1 text-zinc-300 hover:text-zinc-100 cursor-pointer"
            title="{{ __('common.about') }} GISELA &hellip;"
            @click="dialogInfo = true"
        >
            <span aria-hidden="true">@svg('mdi-information', 'size-6')</span>
            <span class="sr-only">{{ __('common.about') }} GISELA &hellip;</span> 
        </button>
    </div>
</div>