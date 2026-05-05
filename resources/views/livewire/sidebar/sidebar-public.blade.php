<div>
    <flux:sidebar collapsible="mobile" class="w-[18rem]! p-0! flex flex-col gap-0! h-full grow bg-zinc-100 dark:bg-zinc-800">
        <flux:sidebar.header class="flex h-[4rem] shrink-0 items-center bg-zinc-100 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700 border-r lg:border-r-0 border-r-zinc-300  dark:border-r-zinc-700 z-10">
            <a wire:navigate href="/" class="h-full flex flex-1 items-center justify-start lg:justify-center px-6">
                @if(file_exists(public_path('logo.svg')) && file_exists(public_path('logo-small.svg')))
                    <img class="h-8 w-auto hidden lg:inline" src="{{ asset('logo.svg') }}" alt="{{ config('app.name') }}">
                    <img class="h-8 w-auto lg:hidden" src="{{ asset('logo-small.svg') }}" alt="{{ config('app.name') }}">
                @else
                    <span class="text-zinc-800 dark:text-white text-xl font-semibold">{{ config('app.name') }}</span>
                @endif
            </a>
            <flux:sidebar.collapse class="mr-3 lg:hidden" />
        </flux:sidebar.header>

        <div class="grow overflow-y-auto border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.nav class="px-6 py-4">
                <flux:sidebar.item
                    :current="str_contains(Route::getFacadeRoot()->current()->uri(), '/infos')"
                    wire:navigate
                    href="{{ route('public-infos', ['election' => $electionID]) }}"
                    icon="info"
                >
                    {{ __('messages.election_infos') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            @if($showCandidacy || $showEditCandidacy)
                <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 px-6 mb-2">{{ __('candidacy.candidacy') }}</div>
                @auth
                    <flux:sidebar.nav class="px-6 pb-4">
                        @if($showCandidacy)
                            <flux:sidebar.item
                                wire:navigate
                                href="{{ route('candidacy', ['election' => $electionID]) }}"
                                icon="users"
                            >
                                {{ __('candidacy.submitCandidacy') }}
                            </flux:sidebar.item>
                        @endif
                        @if($showEditCandidacy)
                            <flux:sidebar.item
                                wire:navigate
                                href="{{ route('candidacy-my', ['election' => $electionID]) }}"
                                icon="users"
                            >
                                {{ __('candidacy.myCandidacies') }}
                            </flux:sidebar.item>
                        @endif
                    </flux:sidebar.nav>
                @else
                    <div class="px-6 pb-4">
                        <flux:button
                            icon="log-in"
                            href="/auth/login"
                            class="w-full"
                        >
                            {{ __('common.login') }}
                        </flux:button>
                    </div>
                @endauth
            @endif

            @if(count($committees) > 0)
                @if($allVotesCounted)
                    <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 px-6 mb-2">{{ __('messages.results') }}</div>
                @elseif($candidatesExist)
                    <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 px-6 mb-2">{{ __('messages.candidates') }}</div>
                @else
                    <div class="font-semibold leading-6 text-zinc-600 dark:text-zinc-300 px-6 mb-2">{{ __('messages.committee_infos') }}</div>
                @endif
                <flux:sidebar.nav class="px-6 pb-4">
                    @foreach ($committees as $committee)
                        @if($allVotesCounted)
                            @php
                                if (app()->getLocale() === 'en') {
                                    $committeeName = json_decode($committee->name, true)[1];
                                } else {
                                    $committeeName = json_decode($committee->name, true)[0];
                                }
                            @endphp
                            <flux:sidebar.item
                                :current="!empty($committeeID) && $committeeID == $committee->id"
                                wire:navigate
                                href="{{ route('public-results', ['election' => $electionID, 'committee' => $committee->id]) }}"
                                icon="users"
                                title="{{ $committeeName }}"
                            >
                                {{ $committeeName }}
                            </flux:sidebar.item>
                        @elseif($candidatesExist)
                            <flux:sidebar.item
                                wire:navigate
                                href="{{ route('public-candidates', ['election' => $electionID, 'committee' => $committee->id]) }}"
                                icon="users"
                            >
                                @if(app()->getLocale() == "en")
                                    {{ json_decode($committee->name, true)[1] }}
                                @else
                                    {{ json_decode($committee->name, true)[0] }}
                                @endif
                            </flux:sidebar.item>
                        @else
                            <flux:sidebar.item
                                wire:navigate
                                href="{{ route('public-committee', ['id' => $committee->id, 'election' => $electionID]) }}"
                                icon="users"
                            >
                                @if(app()->getLocale() == "en")
                                    {{ json_decode($committee->name, true)[1] }}
                                @else
                                    {{ json_decode($committee->name, true)[0] }}
                                @endif
                            </flux:sidebar.item>
                            @endif
                    @endforeach
                </flux:sidebar.nav>
            @endif
        </div>
    </flux:sidebar>
</div>
