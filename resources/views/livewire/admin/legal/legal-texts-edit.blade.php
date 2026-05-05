<div class="flex flex-col p-6 sm:p-8 pb-0! overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.legalTexts') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.imprintDE') }}</flux:label>
                <flux:textarea wire:model="imprintDE" class="h-60"></flux:textarea>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.imprintEN') }}</flux:label>
                <flux:textarea wire:model="imprintEN" class="h-60"></flux:textarea>
            </flux:field>
        </div>

        <div class="mt-6 grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.privacyPolicyDE') }}</flux:label>
                <flux:textarea wire:model="privacyDE" class="h-60"></flux:textarea>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.privacyPolicyEN') }}</flux:label>
                <flux:textarea wire:model="privacyEN" class="h-60"></flux:textarea>
            </flux:field>
        </div>

        <div class="mt-6 grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.accessibilityStatementDE') }}</flux:label>
                <flux:textarea wire:model="accessibilityDE" class="h-60"></flux:textarea>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.accessibilityStatementEN') }}</flux:label>
                <flux:textarea wire:model="accessibilityEN" class="h-60"></flux:textarea>
            </flux:field>
        </div>
    </div>
    <div class="mt-auto py-6 -mx-8 px-8 flex items-center justify-end gap-x-4 border-t border-zinc-200 dark:border-zinc-900 bg-zinc-100 dark:bg-zinc-800">
        <flux:button variant="primary" icon="save" wire:click="save">
            {{ __('common.save') }}
        </flux:button>
    </div>
</div>
