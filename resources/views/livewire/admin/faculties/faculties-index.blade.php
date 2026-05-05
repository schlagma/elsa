<div class="p-6 sm:p-8 overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.faculties') }}</h1>
        </div>
        <div class="mt-4 xl:ml-16 xl:mt-0 flex flex-col sm:flex-row whitespace-nowrap">
            <flux:button variant="primary" icon="plus" wire:navigate href="{{ route('admin-faculties-add') }}">
                {{ __('admin.addFaculty') }}
            </flux:button>
        </div>
    </div>
    <div class="mt-6">
        @if(count($faculties) > 0)
            <flux:table>
                <flux:table.columns>
                    <flux:table.column class="min-w-56">{{ __('admin.name') }}</flux:table.column>
                    <flux:table.column><span class="sr-only">{{ __('admin.options') }}</span></flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach($faculties as $faculty)
                        <flux:table.row>
                            <flux:table.cell>@if(app()->getLocale() == "de"){{ json_decode($faculty->name)[0] }}@elseif(app()->getLocale() == "en"){{ json_decode($faculty->name)[1] }}@endif</flux:table.cell>
                            <flux:table.cell class="whitespace-nowrap text-right">
                                <flux:dropdown>
                                    <flux:button size="sm" icon="ellipsis-vertical" />
                                    <flux:menu>
                                        <flux:menu.item
                                            wire:navigate
                                            href="{{ route('admin-faculties-edit', ['id' => $faculty->id]) }}"
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
                <flux:pagination :paginator="$faculties" />
            </div>
        @else
            <div>
                <p class="text-zinc-800 dark:text-white">{{ __('admin.noResults') }}</p>
            </div>
        @endif
    </div>
</div>