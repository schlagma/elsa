<div class="p-6 sm:p-8 dark:text-white">
    <div class="grid grid-cols-[1fr_auto] gap-x-4">
        <div>
            <p class="mb-2 dark:text-white">
                @if(app()->getLocale() == "en")
                    {{ $electionName[1] }} &rarr;
                @else
                    {{ $electionName[0] }} &rarr;
                @endif
                {{ __('messages.candidates') }}
            </p>
            @if(app()->getLocale() == "en")
                @if ($committee->lists)
                    <h1 class="mb-2! dark:text-white">{{ json_decode($committee->name)[1] }}</h1>
                @else
                    <h1 class="mb-6! dark:text-white">{{ json_decode($committee->name)[1] }}</h1>
                @endif
            @else
                @if ($committee->lists)
                    <h1 class="mb-2! dark:text-white">{{ json_decode($committee->name)[0] }}</h1>
                @else
                    <h1 class="mb-6! dark:text-white">{{ json_decode($committee->name)[0] }}</h1>
                @endif
            @endif
        </div>
        <div class="pt-4">
            <a
                wire:navigate
                href="{{ route('public-committee', ['id' => $committeeID, 'election' => $electionID]) }}"
                title="{{ __('messages.info_on_this_committee')}}"
                class="text-zinc-500 dark:text-zinc-400 hover:text-zinc-800 dark:hover:text-white"
            >
                <span aria-hidden="true">@svg('mdi-information', 'size-6')</span>
                <span class="sr-only">{{ __('messages.info_on_this_committee')}}</span>
            </a>
        </div>
    </div>
    @if ($committee->lists)
        @foreach ($lists as $list)
            @if(app()->getLocale() == "en")
                <h2>{{ json_decode($list->name, true)[1] }}</h2>
            @else
                <h2>{{ json_decode($list->name, true)[0] }}</h2>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4">
                <div>
                    <div class="results-info-box border-2! border-emerald-800!">
                        <div><strong>{{ __('messages.seats_voting_rights') }}</strong></div>
                        <div>{{ $list->seats }}</div>
                    </div>
                </div>
                <div>
                    <div class="results-info-box border-2! border-lime-600!">
                        <div><strong>{{ __('messages.seats_deputy') }}</strong></div>
                        <div>{{ $list->seats_deputy }}</div>
                    </div>
                </div>
            </div>
            @php
                $indexPeople = 0;
            @endphp
            @foreach ($candidates as $candidate)
                @if ($candidate->list == $list->id)
                    <a wire:navigate class="candidate-box" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                        <div>
                            <span class="candidate-number">{{ $indexPeople + 1 }}</span>
                        </div>
                        <div><strong>{{ trim($candidate->firstname) }} {{ trim($candidate->lastname) }}</strong></div>
                        <div>
                            @if(app()->getLocale() == "en")
                                {{ json_decode($candidate->name, true)[1] }}
                            @else
                                {{ json_decode($candidate->name, true)[0] }}
                            @endif
                        </div>
                    </a>
                    @php
                        $indexPeople++;
                    @endphp
                @endif
            @endforeach
            @if ($indexPeople == 0)
                <div class="px-6 py-3 bg-zinc-100 dark:bg-zinc-800 rounded-md shadow-xs dark:shadow-md border border-zinc-300 dark:border-zinc-600 overflow-hidden mb-4 dark:text-white">
                    {{ __('messages.no_candidates_list') }}
                </div>
            @endif
        @endforeach
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 mb-6">
            <div>
                <div class="results-info-box border-2! border-emerald-800!">
                    <div><strong>{{ __('messages.seats_voting_rights') }}</strong></div>
                    <div>{{ $committee->seats }}</div>
                </div>
            </div>
            <div>
                <div class="results-info-box border-2! border-lime-600!">
                    <div><strong>{{ __('messages.seats_deputy') }}</strong></div>
                    <div>{{ $committee->seats_deputy }}</div>
                </div>
            </div>
        </div>
        @foreach ($candidates as $candidate)
            <a wire:navigate class="candidate-box" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                <div class="py-0! pr-0!">
                    <span class="candidate-number">{{ $loop->iteration }}</span>
                </div>
                <div><strong>{{ trim($candidate->firstname) }} {{ trim($candidate->lastname) }}</strong></div>
                <div>
                    @if(app()->getLocale() == "en")
                        {{ json_decode($candidate->name, true)[1] }}
                    @else
                        {{ json_decode($candidate->name, true)[0] }}
                    @endif
                </div>
            </a>
        @endforeach
    @endif
</div>
