<div class="flex flex-col p-6 sm:p-8 !pb-0 overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.candidatesAddTitle') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <div>
                <label>{{ __('admin.election') }}</label>
                <select wire:model.change="election">
                    <option value="">{{ __('common.selectAnOption') }}</option>
                    @foreach ($elections as $election)
                    <option value="{{ $election->id }}">{{ json_decode($election->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>{{ __('admin.committee') }}</label>
                <select wire:model.change="committee">
                    <option value="">{{ __('common.selectAnOption') }}</option>
                    @foreach ($committees as $committee)
                    <option value="{{ $committee->id }}">{{ json_decode($committee->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            @if (count($lists) > 0)
            <div>
                <label>{{ __('admin.list') }}</label>
                <select wire:model.change="list">
                    <option value="">{{ __('common.selectAnOption') }}</option>
                    @foreach ($lists as $list)
                    <option value="{{ $list->id }}">{{ json_decode($list->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        <div class="mt-10">
            <div class="grid sm:grid-cols-2 md:grid-cols-[1fr_1fr_1fr_auto] gap-x-2 gap-y-2 md:gap-y-2">
                <label class="-mb-1 hidden md:inline">{{ __('admin.emailAddress') }}</label>
                <label class="-mb-1 hidden md:inline">{{ __('admin.faculty') }}</label>
                <label class="-mb-1 hidden md:inline">{{ __('admin.course') }}</label>
                <div class="-mb-1 hidden md:inline"></div>
                @foreach ($candidates as $index => $candidate)
                <input type="text" wire:model="candidates.{{ $index }}.email" placeholder="max.mustermann@tu-ilmenau.de">
                <select wire:model="candidates.{{ $index }}.faculty">
                    <option value="">{{ __('common.selectAnOption') }}</option>
                    @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ json_decode($faculty->name)[0] }}</option>
                    @endforeach
                </select>
                <select wire:model="candidates.{{ $index }}.course" class="sm:mb-4 md:mb-0">
                    <option value="">{{ __('common.selectAnOption') }}</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ json_decode($course->name)[0] }}</option>
                    @endforeach
                </select>
                <div class="flex">
                    <button class="btn-neutral mb-4 md:mb-0 ml-auto sm:ml-0" wire:click="removeCandidate({{ $index }})" title="{{ __('admin.removeCandidate') }}">
                        @svg('mdi-minus', 'size-5')
                    </button>
                </div>
                @endforeach
            </div>
            <div class="mt-2 md:mt-6">
                <button class="btn-neutral" wire:click="addCandidate">
                    @svg('mdi-plus', 'size-5 -ml-0.5')
                    {{ __('admin.addCandidate') }}
                </button>
            </div>
        </div>
    </div>
    <div class="mt-auto py-6 -mx-8 px-8 flex items-center justify-end gap-x-4 border-t border-zinc-200 dark:border-zinc-900 bg-zinc-100 dark:bg-zinc-800">
        <a wire:navigate href="{{ route('admin-candidates-index') }}" class="btn-neutral">
            <span aria-hidden="true">@svg('mdi-cancel', '-ml-0.5 size-5')</span>
            {{ __('common.cancel') }}
        </a>
        <button wire:click="save" class="btn-primary">
            <span aria-hidden="true">@svg('mdi-content-save', '-ml-0.5 size-5')</span>
            {{ __('common.add') }}
        </button>
    </div>
</div>