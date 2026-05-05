<div class="flex flex-col p-6 sm:p-8 pb-0! overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.questionsEditTitle') }}</h1>
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
        <div class="mt-6">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>{{ __('admin.questionsDE') }}</flux:table.column>
                    <flux:table.column>{{ __('admin.questionsEN') }}</flux:table.column>
                    <flux:table.column class="w-[3.4rem]"></flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach($questionsDE as $index => $question)
                        <flux:table.row>
                            <flux:table.cell>
                                <flux:input type="text" wire:model="questionsDE.{{ $index }}" />
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:input type="text" wire:model="questionsEN.{{ $index }}" />
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:button icon="minus" wire:click="removeQuestion({{ $index }})" title="{{ __('admin.removeQuestion') }}" />
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
            <div class="border-t border-zinc-200 dark:border-zinc-700 pt-3">
                <flux:button icon="plus" type="button" wire:click="addQuestion">
                    {{ __('admin.addQuestion') }}
                </flux:button>
            </div>
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