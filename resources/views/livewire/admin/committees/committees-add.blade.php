<div class="flex flex-col p-6 sm:p-8 !pb-0 overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.committeesAddTitle') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label>{{ __('admin.nameDE') }}</label>
                <input type="text" wire:model="nameDE" class="w-full">
            </div>
            <div>
                <label>{{ __('admin.nameEN') }}</label>
                <input type="text" wire:model="nameEN" class="w-full">
            </div>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 gap-6">
            <div>
                <label>{{ __('admin.infotextDE') }}</label>
                <textarea wire:model="infotextDE" class="w-full h-[15rem]"></textarea>
            </div>
            <div>
                <label>{{ __('admin.infotextEN') }}</label>
                <textarea wire:model="infotextEN" class="w-full h-[15rem]"></textarea>
            </div>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <div>
                <label>{{ __('admin.seats') }}</label>
                <input type="number" wire:model="seats" class="w-full">
            </div>
            <div>
                <label>{{ __('admin.seatsDeputy') }}</label>
                <input type="number" wire:model="seatsDeputy" class="w-full">
            </div>
            <div>
                <label>{{ __('admin.elections') }}</label>
                <select wire:model="committeeElections" multiple>
                    @foreach ($elections as $election)
                        <option value="{{ $election->id }}">{{ json_decode($election->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <div>
                <label for="checkboxLists">{{ __('admin.committeeHasLists') }}</label>
                <input id="checkboxLists" type="checkbox" wire:model="lists">
            </div>
            <div>
                <label for="checkboxListsQuoted">{{ __('admin.committeeListsAreQuoted') }}</label>
                <input id="checkboxListsQuoted" type="checkbox" wire:model="listsQuoted">
            </div>
            <div>
                <label for="checkboxActive">{{ __('admin.active') }}</label>
                <input id="checkboxActive" type="checkbox" wire:model="active">
            </div>
        </div>
    </div>
    <div class="mt-auto py-6 -mx-8 px-8 flex items-center justify-end gap-x-4 border-t border-zinc-200 dark:border-zinc-900 bg-zinc-100 dark:bg-zinc-800">
        <a wire:navigate href="{{ url()->previous() }}" class="btn-neutral">
            <span aria-hidden="true">@svg('mdi-cancel', '-ml-0.5 size-5')</span>
            {{ __('common.cancel') }}
        </a>
        <button wire:click="save" class="btn-primary">
            <span aria-hidden="true">@svg('mdi-content-save', '-ml-0.5 size-5')</span>
            {{ __('common.save') }}
        </button>
    </div>
</div>