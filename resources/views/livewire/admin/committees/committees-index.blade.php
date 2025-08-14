<div class="p-6 sm:p-8 overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.committees') }}</h1>
        </div>
        <div class="mt-4 xl:ml-16 xl:mt-0 flex flex-col sm:flex-row whitespace-nowrap">
            <a wire:navigate href="{{ route('admin-committees-add') }}" type="button" class="btn-primary">
                <span aria-hidden="true">@svg('mdi-plus', '-ml-0.5 size-5')</span>
                {{ __('admin.addCommittee') }}
            </a>
        </div>
    </div>
    <div class="mt-6">
        <div class="-mx-6 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                @if (count($committees) > 0)
                <div class="overflow-hidden shadow-sm ring-1 ring-black/5 sm:rounded-lg">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" class="min-w-[14rem]">{{ __('admin.name') }}</th>
                                <th scope="col"><span class="sr-only">{{ __('admin.options') }}</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($committees as $committee)
                            <tr>
                                <td>@if(app()->getLocale() == "de"){{ json_decode($committee->name)[0] }}@elseif(app()->getLocale() == "en"){{ json_decode($committee->name)[1] }}@endif</td>
                                <td class="whitespace-nowrap text-right">
                                    <div class="relative inline-block text-left" x-data="{ dropdown: false }">                                            
                                        <div>
                                            <button class="relative top-[2px] rounded-md px-2 py-1 -my-1 hover:bg-zinc-200 dark:hover:bg-zinc-600 focus:bg-zinc-200 dark:focus:bg-zinc-600 active:bg-zinc-200 dark:active:bg-zinc-600 cursor-pointer" @click="dropdown = true">
                                                <span aria-hidden="true">@svg('mdi-dots-vertical', 'text-zinc-800 dark:text-white size-5')</span>
                                                <span class="sr-only">Optionen</span>
                                            </button>
                                        </div>

                                        @if ($loop->index < count($committees) - 2)
                                        <div x-show="dropdown" @click.outside="dropdown = false" class="absolute right-0 z-10 mt-1 origin-top-right divide-y divide-zinc-200 dark:divide-zinc-700 rounded-md bg-white dark:bg-zinc-800 shadow-lg ring-1 ring-black/5 dark:ring-white/5">
                                        @else
                                        <div x-show="dropdown" @click.outside="dropdown = false" class="absolute right-0 bottom-8 z-10 mt-1 origin-top-right divide-y divide-zinc-200 dark:divide-zinc-700 rounded-md bg-white dark:bg-zinc-800 shadow-lg ring-1 ring-black/5 dark:ring-white/5">
                                        @endif
                                            <div class="py-1">
                                                <a wire:navigate href="{{ route('admin-committees-edit', ['id' => $committee->id]) }}" class="text-zinc-800 dark:text-white group flex items-center px-4 py-2 border-0 hover:bg-zinc-200 dark:hover:bg-zinc-700 !font-normal">
                                                    <span aria-hidden="true">@svg('mdi-file-edit', 'mr-3 size-5 text-zinc-500 dark:text-zinc-300')</span>
                                                    {{ __('common.edit') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div>
                    <p class="text-zinc-800 dark:text-white">{{ __('admin.noResults') }}</p>
                </div>
                @endif
            </div>
        </div>
        @if(count($committees) > 0)
        <div class="mt-6">
            {{ $committees->onEachSide(1)->links() }}
        </div>
        @endif
    </div>
</div>