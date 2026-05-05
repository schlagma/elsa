<flux:modal.trigger name="info">
    <flux:button
        variant="ghost"
        icon="info"
        title="{{ __('messages.about') }} {{ config('app.name') }} &hellip;"
        class="-mr-4!"
    />
</flux:modal>

<flux:modal name="info" class="max-w-lg">
    <flux:heading size="lg" class="modal-header">{{ config('app.name') }}</flux:heading>
    <div class="text-center">
        <h3 class="text-xl font-bold text-zinc-800 dark:text-white">{{ config('app.name') }} <span class="font-normal ml-1"> 1.1.0</span></h3>
        <div class="mt-2">
            <p class="text-zinc-800 dark:text-white hyphens-none"><b>El</b>ektronisches <b>S</b>ystem für <b>A</b>bstimmungen</p>
        </div>
        <div class="mt-6">
            <p class="text-zinc-800 dark:text-white mb-2">&copy; 2024 &ndash; {{ date('Y') }} Marc Schlagenhauf</p>
        </div>
        <div class="space-y-2 bg-zinc-100 dark:bg-zinc-800 border-t border-zinc-200 dark:border-zinc-700 -mx-6 -mb-6 px-6 py-4 mt-8">
            <div class="flex flex-wrap gap-2 justify-center">
                <flux:button size="sm" icon="external-link" wire:navigate href="{{ route('imprint') }}">{{ __('common.imprint') }}</flux:button>
                <flux:button size="sm" icon="external-link" wire:navigate href="{{ route('privacy') }}">{{ __('common.privacyPolicy') }}</flux:button>
                <flux:button size="sm" icon="external-link" wire:navigate href="{{ route('accessibility') }}">{{ __('common.accessibility') }}</flux:button>
            </div>
        </div>
    </div>
</flux:modal>