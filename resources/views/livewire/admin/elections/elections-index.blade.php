<div class="p-6 sm:p-8 overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.elections') }}</h1>
        </div>
        <div class="mt-4 xl:ml-16 xl:mt-0 flex flex-col sm:flex-row whitespace-nowrap">
            <flux:button
                variant="primary"
                icon="plus"
                wire:navigate
                href="{{ route('admin-elections-add') }}"
            >
                {{ __('admin.addElection') }}
            </flux:button>
        </div>
    </div>
    <div class="mt-6">
        @if (count($elections) > 0)
            <flux:table>
                <flux:table.columns>
                        <flux:table.column class="min-w-36">{{ __('admin.name') }}</flux:table.column>
                        <flux:table.column class="min-w-52">{{ __('admin.candidatesExist') }}</flux:table.column>
                        <flux:table.column class="min-w-52">{{ __('admin.allVotesCounted') }}</flux:table.column>
                        <flux:table.column class="min-w-32">{{ __('admin.electionIsPublic') }}</flux:table.column>
                        <flux:table.column><span class="sr-only">{{ __('admin.options') }}</span></flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach($elections as $election)
                        <flux:table.row>
                            <flux:table.cell>
                                @if(app()->getLocale() == "de")
                                    {{ json_decode($election->name)[0] }}
                                @elseif(app()->getLocale() == "en")
                                    {{ json_decode($election->name)[1] }}
                                @endif
                            </flux:table.cell>
                            <flux:table.cell>
                                @if($election->candidates_exist)
                                    <flux:icon.check class="size-6 text-green-600 dark:text-green-500" aria-hidden="true" />
                                    <span class="sr-only">{{ __('admin.yes') }}</span>
                                @else
                                    <flux:icon.x class="size-6 text-red-600 dark:text-red-300" aria-hidden="true" />
                                    <span class="sr-only">{{ __('admin.no') }}</span>
                                @endif
                            </flux:table.cell>
                            <flux:table.cell>
                                @if($election->all_votes_counted)
                                    <flux:icon.check class="size-6 text-green-600 dark:text-green-500" aria-hidden="true" />
                                    <span class="sr-only">{{ __('admin.yes') }}</span>
                                @else
                                    <flux:icon.x class="size-6 text-red-600 dark:text-red-300" aria-hidden="true" />
                                    <span class="sr-only">{{ __('admin.no') }}</span>
                                @endif
                            </flux:table.cell>
                            <flux:table.cell>
                                @if($election->public)
                                    <flux:icon.check class="size-6 text-green-600 dark:text-green-500" aria-hidden="true" />
                                    <span class="sr-only">{{ __('admin.yes') }}</span>
                                @else
                                    <flux:icon.x class="size-6 text-red-600 dark:text-red-300" aria-hidden="true" />
                                    <span class="sr-only">{{ __('admin.no') }}</span>
                                @endif
                            </flux:table.cell>
                            <flux:table.cell class="whitespace-nowrap text-right">
                                <flux:dropdown>
                                    <flux:button size="sm" icon="ellipsis-vertical" />
                                    <flux:menu>
                                        <flux:menu.item
                                            wire:navigate
                                            href="{{ route('admin-elections-edit', ['id' => $election->id]) }}"
                                            icon="pencil"
                                        >
                                            {{ __('common.edit') }}
                                        </flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>

            <div class="pagination">
                <flux:pagination :paginator="$elections" />
            </div>
        @else
            <div>
                <p class="text-zinc-800 dark:text-white">{{ __('admin.noResults') }}</p>
            </div>
        @endif
    </div>
</div>