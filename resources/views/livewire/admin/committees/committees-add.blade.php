<div class="flex flex-col p-6 sm:p-8 pb-0! overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.committeesAddTitle') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.nameDE') }}</flux:label>
                <flux:input type="text" wire:model="nameDE" class="w-full" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.nameEN') }}</flux:label>
                <flux:input type="text" wire:model="nameEN" class="w-full" />
            </flux:field>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.infotextDE') }}</flux:label>
                <flux:textarea wire:model="infotextDE" class="w-full h-60 font-mono" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.infotextEN') }}</flux:label>
                <flux:textarea wire:model="infotextEN" class="w-full h-60 font-mono" />
            </flux:field>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <flux:field>
                <flux:label>{{ __('admin.seats') }}</flux:label>
                <flux:input type="number" wire:model="seats" class="w-full" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.seatsDeputy') }}</flux:label>
                <flux:input type="number" wire:model="seatsDeputy" class="w-full" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('admin.elections') }}</flux:label>
                <flux:pillbox wire:model="committeeElections" multiple searchable>
                    @foreach($elections as $election)
                        <flux:pillbox.option value="{{ $election->id }}">{{ json_decode($election->name)[0] }}</flux:pillbox.option>
                    @endforeach
                </flux:pillbox>
            </flux:field>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <flux:field>
                <flux:label for="checkboxLists">{{ __('admin.committeeHasLists') }}</flux:label>
                <flux:checkbox wire:model="lists" />
            </flux:field>
            <flux:field>
                <flux:label for="checkboxListsQuoted">{{ __('admin.committeeListsAreQuoted') }}</flux:label>
                <flux:checkbox wire:model="listsQuoted" />
            </flux:field>
            <flux:field>
                <flux:label for="checkboxActive">{{ __('admin.active') }}</flux:label>
                <flux:checkbox wire:model="active" />
            </flux:field>
        </div>
    </div>
    <div class="mt-auto py-6 -mx-8 px-8 flex items-center justify-end gap-x-4 border-t border-zinc-200 dark:border-zinc-900 bg-zinc-100 dark:bg-zinc-800">
        <flux:button icon="ban" wire:navigate href="{{ url()->previous() }}">
            {{ __('common.cancel') }}
        </flux:button>
        <flux:button variant="primary" icon="save" wire:click="save">
            {{ __('common.save') }}
        </flux:button>
    </div>
</div>