<div class="flex flex-col p-6 sm:p-8 pb-0! overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.resultsEditTitle') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.election') }}</flux:label>
                <flux:select variant="listbox" searchable wire:model="election">
                    @foreach($elections as $election)
                        <flux:select.option value="{{ $election->id }}">{{ json_decode($election->name)[0] }}</flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.committee') }}</flux:label>
                <flux:select variant="listbox" searchable wire:model="committee">
                    @foreach($committees as $committee)
                        <flux:select.option value="{{ $committee->id }}">{{ json_decode($committee->name)[0] }}</flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.eligibleVoters') }}</flux:label>
                <flux:input type="number" wire:model="eligibleVoters" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.ballotsCast') }}</flux:label>
                <flux:input type="number" wire:model="ballotsCast" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.ballotsInvalid') }}</flux:label>
                <flux:input type="number" wire:model="ballotsInvalid" />
            </flux:field>
        </div>
    </div>
    <div class="mt-auto py-6 -mx-8 px-8 flex items-center justify-end gap-x-4 border-t border-zinc-200 dark:border-zinc-900 bg-zinc-100 dark:bg-zinc-800">
        <flux:button
            icon="ban"
            wire:navigate
            href="{{ url()->previous() }}"
        >
            {{ __('common.cancel') }}
        </flux:button>
        <flux:button variant="primary" icon="save" wire:click="save">
            {{ __('common.save') }}
        </flux:button>
    </div>
</div>