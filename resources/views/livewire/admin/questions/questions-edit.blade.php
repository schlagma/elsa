<div class="flex flex-col p-6 sm:p-8 pb-0! overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.questionsEditTitle') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label>{{ __('admin.election') }}</label>
                <select wire:model="election">
                    @foreach ($elections as $election)
                    <option value="{{ $election->id }}">{{ json_decode($election->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>{{ __('admin.committee') }}</label>
                <select wire:model="committee">
                    @foreach ($committees as $committee)
                    <option value="{{ $committee->id }}">{{ json_decode($committee->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-6 grid md:grid-cols-2 gap-6">
            <div>
                <label>{{ __('admin.questionsDE') }}</label>
                <div class="grid grid-cols-[1fr_auto] gap-2">
                    @foreach ($questionsDE as $index => $question)
                    <input type="text" wire:model="questionsDE.{{ $index }}">
                    <button wire:click="removeQuestion({{ $index }})" class="btn-neutral" title="{{ __('admin.removeQuestion') }}">
                        <span aria-hidden="true">@svg('mdi-minus', 'size-5')</span>
                        <span class="sr-only">{{ __('admin.removeQuestion') }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
            <div>
                <label>{{ __('admin.questionsEN') }}</label>
                <div class="grid grid-cols-[1fr_auto] gap-2">
                    @foreach ($questionsEN as $index => $question)
                    <input type="text" wire:model="questionsEN.{{ $index }}">
                    <button wire:click="removeQuestion({{ $index }})" class="btn-neutral" title="{{ __('admin.removeQuestion') }}">
                        <span aria-hidden="true">@svg('mdi-minus', 'size-5')</span>
                        <span class="sr-only">{{ __('admin.removeQuestion') }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
            <div>
                <button type="button" wire:click="addQuestion" class="btn-neutral -mt-2">
                    <span aria-hidden="true">@svg('mdi-plus', '-ml-0.5 size-5')</span>
                    {{ __('admin.addQuestion') }}
                </button>
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