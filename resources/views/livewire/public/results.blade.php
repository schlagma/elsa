<div class="p-6 sm:p-8 dark:text-white">
    <div class="grid grid-cols-[1fr_auto] gap-x-4">
        <div>
            <p class="mb-2 dark:text-white">
                @if(app()->getLocale() == "en")
                    {{ $electionName[1] }} &rarr;
                @else
                    {{ $electionName[0] }} &rarr;
                @endif
                {{ __('messages.results') }}
            </p>
            @if(app()->getLocale() == "en")
                <h1 class="mb-6! dark:text-white">{{ json_decode($committee->name)[1] }}</h1>
            @else
                <h1 class="mb-6! dark:text-white">{{ json_decode($committee->name)[0] }}</h1>
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

    @if($committee->lists)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 mb-6">
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-4 mb-6">
            <div>
                <div class="results-info-box border-2! border-green-700!">
                    <div><strong>{{ __('messages.seats_voting_rights') }}</strong></div>
                    <div>{{ $committee->seats }}</div>
                </div>
                <div class="results-info-box border-2! border-lime-500!">
                    <div><strong>{{ __('messages.seats_deputy') }}</strong></div>
                    <div>{{ $committee->seats_deputy }}</div>
                </div>
            </div>
    @endif
        <div>
            <div class="results-info-box">
                <div><strong>{{ __('messages.voters_eligible') }}</strong></div>
                <div>{{ $results->eligible_voters }}</div>
            </div>
            <div class="results-info-box">
                <div><strong>{{ __('messages.voters_participated') }}</strong></div>
                <div>{{ $results->ballots_cast }}</div>
            </div>
            <div class="results-info-box">
                <div><strong>{{ __('messages.voters_turnout') }}</strong></div>
                <div>{{ round((($results->ballots_cast / $results->eligible_voters) * 100), 2) }} %</div>
            </div>
        </div>
        <div>
            <div class="results-info-box">
                <div><strong>{{ __('messages.ballots_total') }}</strong></div>
                <div>{{ $results->ballots_cast }}</div>
            </div>
            <div class="results-info-box">
                <div><strong>{{ __('messages.ballots_valid') }}</strong></div>
                <div>{{ $results->ballots_cast - $results->ballots_invalid }}</div>
            </div>
            <div class="results-info-box">
                <div><strong>{{ __('messages.ballots_invalid') }}</strong></div>
                <div>{{ $results->ballots_invalid }}</div>
            </div>
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
                    <div class="results-info-box border-2! border-green-700!">
                        <div><strong>{{ __('messages.seats_voting_rights') }}</strong></div>
                        <div>{{ $list->seats }}</div>
                    </div>
                </div>
                <div>
                    <div class="results-info-box border-2! border-lime-500!">
                        <div><strong>{{ __('messages.seats_deputy') }}</strong></div>
                        <div>{{ $list->seats_deputy }}</div>
                    </div>
                </div>
            </div>
            @php
                $indexPeople = 0;
                $resignedCandidates = false;
            @endphp
            @foreach ($candidates as $candidate)
                @if ($candidate->list == $list->id)
                    @if (!$candidate->resigned)
                        @if ($indexPeople < $list->seats)
                            <a wire:navigate class="candidate-box candidate-box-results border-2! border-green-700! border-solid!" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                            <div class="py-0! pr-0!">
                                <span class="candidate-number bg-green-700! text-white!">{{ $indexPeople + 1 }}</span>
                            </div>
                        @elseif ($indexPeople < ($list->seats + $list->seats_deputy))
                            <a wire:navigate class="candidate-box candidate-box-results border-2! border-lime-500! border-solid!" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                            <div class="py-0! pr-0!">
                                <span class="candidate-number bg-lime-500! text-zinc-800!">{{ $indexPeople + 1 }}</span>
                            </div>
                        @else
                            <a wire:navigate class="candidate-box candidate-box-results" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                            <div class="py-0! pr-0!">
                                <span class="candidate-number">{{ $indexPeople + 1 }}</span>
                            </div>
                        @endif
                            <div><strong>{{ trim($candidate->firstname) }} {{ trim($candidate->lastname) }}</strong></div>
                            <div>
                                @if(app()->getLocale() == "en")
                                    {{ json_decode($candidate->name, true)[1] }}
                                @else
                                    {{ json_decode($candidate->name, true)[0] }}
                                @endif
                            </div>
                            <div class="text-right">{{ $candidate->votes }} {{ __('messages.votes') }}</div>
                            <div class="text-right">{{ round(($candidate->votes / ($results->ballots_cast - $results->ballots_invalid) * 100), 2)}} %</div>
                        </a>
                        @php
                            $indexPeople++;
                        @endphp
                    @else
                        @php
                            $resignedCandidates = true;
                        @endphp
                    @endif
                @endif
            @endforeach

            @if ($indexPeople == 0)
                <div class="px-6 py-3 bg-zinc-100 dark:bg-zinc-800 rounded-md shadow-xs dark:shadow-md border border-zinc-300 dark:border-zinc-600 overflow-hidden mb-4 dark:text-white">
                    {{ __('messages.no_candidates_list') }}
                </div>
            @endif

            @if($resignedCandidates)
                <div class="mt-8">
                    <p><strong>{{ __('messages.resigned') }}</strong></p>
                    @foreach ($candidates as $candidate)
                        @if ($candidate->resigned)
                            <a wire:navigate class="candidate-box candidate-box-resigned" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                                <div class="py-0! pr-0!">
                                    <span class="candidate-number" aria-hidden="true">
                                        @svg('mdi-close-circle-outline', 'size-6')
                                    </span>
                                </div>
                                <div><strong>{{ trim($candidate->firstname) }} {{ trim($candidate->lastname) }}</strong></div>
                                <div>
                                    @if(app()->getLocale() == "en")
                                        {{ json_decode($candidate->name, true)[1] }}
                                    @else
                                        {{ json_decode($candidate->name, true)[0] }}
                                    @endif
                                </div>
                                <div class="text-right">{{ $candidate->votes }} {{ __('messages.votes') }}</div>
                                <div class="text-right">{{ round(($candidate->votes / ($results->ballots_cast - $results->ballots_invalid) * 100), 2)}} %</div>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
            
        @endforeach
    @else
        @php
            $indexPeople = 0;
        @endphp
        @foreach ($candidates as $candidate)
            @if (!$candidate->resigned)
                @if ($indexPeople < $committee->seats)
                    <a wire:navigate class="candidate-box candidate-box-results border-2! border-green-700!" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                    <div class="py-0! pr-0!">
                        <span class="candidate-number bg-green-700! text-white!">{{ $indexPeople + 1 }}</span>
                    </div>
                @elseif ($indexPeople < ($committee->seats + $committee->seats_deputy))
                    <a wire:navigate class="candidate-box candidate-box-results border-2! border-lime-500!" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                    <div class="py-0! pr-0!">
                        <span class="candidate-number bg-lime-500! text-zinc-800!">{{ $indexPeople + 1 }}</span>
                    </div>
                @else
                    <a wire:navigate class="candidate-box candidate-box-results" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                    <div class="py-0! pr-0!">
                        <span class="candidate-number">{{ $indexPeople + 1 }}</span>
                    </div>
                @endif
                    <div><strong>{{ trim($candidate->firstname) }} {{ trim($candidate->lastname) }}</strong></div>
                    <div>
                        @if(app()->getLocale() == "en")
                            {{ json_decode($candidate->name, true)[1] }}
                        @else
                            {{ json_decode($candidate->name, true)[0] }}
                        @endif
                    </div>
                    <div class="text-right">{{ $candidate->votes }} {{ __('messages.votes') }}</div>
                    <div class="text-right">{{ round(($candidate->votes / ($results->ballots_cast - $results->ballots_invalid) * 100), 2)}} %</div>
                </a>
                @php
                    $indexPeople++;
                @endphp
            @endif
        @endforeach

        @if($indexPeople < count($candidates))
            <div class="mt-8">
                <h2>{{ __('messages.resigned') }}</h2>
                @foreach ($candidates as $candidate)
                    @if ($candidate->resigned)
                        <a wire:navigate class="candidate-box candidate-box-resigned" href="{{ route('public-candidate', ['id' => $candidate->id, 'election' => $electionID, 'committee' => $committeeID]) }}">
                            <div class="py-0! pr-0!">
                                    <span class="candidate-number" aria-hidden="true">
                                        @svg('mdi-close-circle-outline', 'size-6')
                                    </span>
                                </div>
                            <div><strong>{{ trim($candidate->firstname) }} {{ trim($candidate->lastname) }}</strong></div>
                            <div>
                                @if(app()->getLocale() == "en")
                                    {{ json_decode($candidate->name, true)[1] }}
                                @else
                                    {{ json_decode($candidate->name, true)[0] }}
                                @endif
                            </div>
                            <div class="text-right">{{ $candidate->votes }} {{ __('messages.votes') }}</div>
                            <div class="text-right">{{ round(($candidate->votes / ($results->ballots_cast - $results->ballots_invalid) * 100), 2)}} %</div>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    @endif

</div>
