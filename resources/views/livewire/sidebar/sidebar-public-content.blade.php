<div class="grid grid-rows-[auto_1fr] w-full h-screen bg-zinc-100 dark:bg-zinc-800">
    <a wire:navigate class="flex h-16 px-6 shrink-0 items-center bg-zinc-800 border-b border-zinc-900 shadow-xs shadow-black/20" href="{{ route('public-infos', ['election' => $electionID]) }}">
        @if (file_exists(public_path('logo.svg')))
            <img class="h-8 w-auto" src="{{ asset('logo.svg') }}" alt="ELSA-Logo">
        @else
            <span class="mx-auto text-white text-xl">ELSA</span>
        @endif
    </a>
    <nav class="flex flex-1 flex-col px-6 py-4 h-full overflow-y-auto border-r border-zinc-300 dark:border-zinc-900">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    @if(str_contains(Route::getFacadeRoot()->current()->uri(), '/infos'))
                        <li class="active">
                    @else
                        <li>
                    @endif
                        <a wire:navigate href="{{ route('public-infos', ['election' => $electionID]) }}" class="sidebar-nav-button">
                            <span aria-hidden="true">@svg('mdi-information-slab-box', 'size-6')</span>
                            {{ __('messages.election_infos') }}
                        </a>
                    </li>
                </ul>
            </li>
            @if(count($committees) > 0)
            <li>
                @if($allVotesCounted)
                    <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 mb-2">{{ __('messages.results') }}</div>
                @elseif($candidatesExist)
                    <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 mb-2">{{ __('messages.candidates') }}</div>
                @else
                    <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 mb-2">{{ __('messages.committee_infos') }}</div>
                @endif
                <ul role="list" class="-mx-2 space-y-1">
                    @foreach ($committees as $committee)
                        @if(!empty($committeeID) && $committeeID == $committee->id)
                            <li class="active">
                        @else
                            <li>
                        @endif
                            @if($allVotesCounted)
                                <a wire:navigate href="{{ route('public-results', ['election' => $electionID, 'committee' => $committee->id]) }}" class="sidebar-nav-button">
                                    <span aria-hidden="true">@svg('mdi-account-group', 'size-6')</span>
                                    @if(app()->getLocale() == "en")
                                        {{ json_decode($committee->name, true)[1] }}
                                    @else
                                        {{ json_decode($committee->name, true)[0] }}
                                    @endif
                                </a>
                            @elseif($candidatesExist)
                                <a wire:navigate href="{{ route('public-candidates', ['election' => $electionID, 'committee' => $committee->id]) }}" class="sidebar-nav-button">
                                    <span aria-hidden="true">@svg('mdi-account-group', 'size-6')</span>
                                    @if(app()->getLocale() == "en")
                                        {{ json_decode($committee->name, true)[1] }}
                                    @else
                                        {{ json_decode($committee->name, true)[0] }}
                                    @endif
                                </a>
                            @else
                                <a wire:navigate href="{{ route('public-committee', ['id' => $committee->id, 'election' => $electionID]) }}" class="sidebar-nav-button">
                                    <span aria-hidden="true">@svg('mdi-account-group', 'size-6')</span>
                                    @if(app()->getLocale() == "en")
                                        {{ json_decode($committee->name, true)[1] }}
                                    @else
                                        {{ json_decode($committee->name, true)[0] }}
                                    @endif
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
            @endif
        </ul>
    </nav>
</div>