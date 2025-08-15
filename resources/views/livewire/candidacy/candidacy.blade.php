<div class="p-6 sm:p-8 pb-0!">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('candidacy.candidacyTitle') }}</h1>
            <p class="dark:text-white">{{ json_decode($election->name)[0] }}</p>
        </div>
        <div class="mt-4 xl:ml-16 xl:mt-0 flex flex-col sm:flex-row whitespace-nowrap">
            <a href="https://ordnungen.stura.eu/satzung/wahlordnung.html" target="_blank" type="button" class="btn-neutral">
                <span aria-hidden="true">@svg('mdi-file-document', '-ml-0.5 size-5')</span>
                {{ __('candidacy.electionRegulations') }}
            </a>
        </div>
    </div>
    
    <h2 class="dark:text-white">{{ __('candidacy.personAndStudies') }}</h2>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div>
            <label>{{ __('candidacy.firstname') }}</label>
            <input type="text" wire:model="firstname" disabled>
        </div>
        <div>
            <label>{{ __('candidacy.lastname') }}</label>
            <input type="text" wire:model="lastname" disabled>
        </div>
        <div>
            <label>{{ __('candidacy.emailAddress') }}</label>
            <input type="email" wire:model="email" disabled>
        </div>
        <div>
            <label>{{ __('candidacy.faculty') }}</label>
            <select>
                <option value="">{{ __('common.selectAnOption') }}</option>
                @foreach ($faculties as $faculty)
                <option value="{{ $faculty->id }}">
                    @if(app()->getLocale() === 'de')
                        {{ json_decode($faculty->name)[0] }}
                    @elseif(app()->getLocale() === 'en')
                        {{ json_decode($faculty->name)[1] }}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>{{ __('candidacy.course') }}</label>
            <select>
                <option value="">{{ __('common.selectAnOption') }}</option>
                @foreach ($courses as $course)
                <option value="{{ $course->id }}">
                    @if(app()->getLocale() === 'de')
                        {{ json_decode($course->name)[0] }}
                    @elseif(app()->getLocale() === 'en')
                        {{ json_decode($course->name)[1] }}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <h2 class="mt-10 dark:text-white">{{ __('candidacy.committee') }}</h2>
    <div class="grid grid-cols-[auto_1fr] mb-6 shadow-xs dark:shadow-md col-span-2 dark:text-white">
        <div class="bg-yellow-400 p-2 h-full border border-yellow-500 rounded-l-md text-zinc-800">
            <span aria-hidden="true">@svg('mdi-alert-circle-outline', 'size-6')</span>
        </div>
        <div class="pl-4 py-2 pr-4 bg-zinc-100 dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 border-l-0 rounded-r-md"><p class="mb-0">{{ __('candidacy.committeeHint') }}</p></div>
    </div>
    <div class="mt-6 grid sm:grid-cols-2 gap-6">
        <div>
            <label>{{ __('candidacy.committee') }}</label>
            <select wire:model.change="committee">
                <option value="">{{ __('common.selectAnOption') }}</option>
                @foreach ($committees as $committee)
                <option value="{{ $committee->id }}">
                    @if(app()->getLocale() === 'de')
                        {{ json_decode($committee->name)[0] }}
                    @elseif(app()->getLocale() === 'en')
                        {{ json_decode($committee->name)[1] }}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
        @if (count($lists) > 0)
        <div>
            <label>{{ __('candidacy.list') }}</label>
            <select>
                <option value="">{{ __('common.selectAnOption') }}</option>
                @foreach ($lists as $list)
                <option value="{{ $list->id }}">
                    @if(app()->getLocale() === 'de')
                        {{ json_decode($list->name)[0] }}
                    @elseif(app()->getLocale() === 'en')
                        {{ json_decode($list->name)[1] }}
                    @endif
                </option>
                @endforeach
            </select>
        </div>
        @endif
    </div>

    <hr class="my-8 dark:border-zinc-700">

    <p class="dark:text-white">{{ __('candidacy.candidacyHint') }}</p>
    <p class="mb-10 dark:text-white">{{ __('candidacy.privacyHint') }}</p>

    <div class="mt-auto py-6 -mx-8 px-8 flex items-center justify-end gap-x-4 border-t border-zinc-200 dark:border-zinc-900 bg-zinc-100 dark:bg-zinc-800">
        <button wire:click="save" class="btn-primary">
            <span aria-hidden="true">@svg('mdi-invoice-text-send', '-ml-0.5 size-5')</span>
            {{ __('candidacy.send') }}
        </button>
    </div>
</div>