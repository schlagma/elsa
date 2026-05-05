<div class="p-6 sm:p-8 dark:text-white">
    <div class="space-y-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item>
                @if(app()->getLocale() == "en")
                    {{ $electionName[1] }}
                @else
                    {{ $electionName[0] }}
                @endif
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>{{ __('messages.candidates') }}</flux:breadcrumbs.item>
            @if ($allVotesCounted)
                <flux:breadcrumbs.item
                    wire:navigate
                    href="{{ route('public-results', ['election' => $electionID, 'committee' => $committeeID]) }}"
                >
                    @if(app()->getLocale() == "en")
                        {{ $committeeName[1] }}
                    @else
                        {{ $committeeName[0] }}
                    @endif
                </flux:breadcrumbs.item>
            @else
                <flux:breadcrumbs.item
                    wire:navigate
                    href="{{ route('public-candidates', ['election' => $electionID, 'committee' => $committeeID]) }}"
                >
                    @if(app()->getLocale() == "en")
                        {{ $committeeName[1] }}
                    @else
                        {{ $committeeName[0] }}
                    @endif
                </flux:breadcrumbs.item>
            @endif
        </flux:breadcrumbs>
        <h1 class="mb-6! dark:text-white">{{ $candidate->firstname }} {{ $candidate->lastname }}</h1>
    </div>

    @if($candidate->picture != '')
        <div class="xl:grid xl:grid-cols-[1fr_16rem] gap-x-8">
    @else
        <div>
    @endif
        <div>
            <div class="candidate-data-boxes">
                <div>
                    <div class="box-left">{{ __('messages.course') }}</div>
                    <div class="box-right">
                        @if(app()->getLocale() == "en")
                            {{ $courseName[1] }}
                        @else
                            {{ $courseName[0] }}
                        @endif
                    </div>
                </div>
                <div>
                    <div class="box-left">{{ __('messages.faculty') }}</div>
                    <div class="box-right">
                        @if(app()->getLocale() == "en")
                            {{ $facultyName[1] }}
                        @else
                            {{ $facultyName[0] }}
                        @endif
                    </div>
                </div>
                @if($committeeHasLists)
                <div>
                    <div class="box-left">{{ __('messages.list') }}</div><div class="box-right">
                        @if(app()->getLocale() == "en")
                            {{ json_decode($listName->name)[1] }}
                        @else
                            {{ json_decode($listName->name)[0] }}
                        @endif
                    </div>
                </div>
                @endif
            </div>
            <div class="flex flex-col gap-4">
                @php
                    $textExists = false;
                @endphp
                @if(app()->getLocale() == "en")
                    @for($i = 0; $i < count($questions[1]); $i++)
                        @if ($answers != [] && $answers[1][$i] != null && $answers[1][$i] != "")
                            <div class="question-answer-box">
                                <div>{{ $questions[1][$i] }}</div>
                                <div>{!! Illuminate\Support\Str::markdown($answers[1][$i]) !!}</div>
                            </div>
                            @php
                                $textExists = true;
                            @endphp
                        @endif
                    @endfor
                @else
                    @for($i = 0; $i < count($questions[0]); $i++)
                        @if ($answers != [] && $answers[0][$i] != null && $answers[0][$i] != "")
                            <div class="question-answer-box">
                                <div>{{ $questions[0][$i] }}</div>
                                <div>{!! Illuminate\Support\Str::markdown($answers[0][$i]) !!}</div>
                            </div>
                            @php
                                $textExists = true;
                            @endphp
                        @endif
                    @endfor
                @endif
            </div>
        </div>
        @if($candidate->picture != '')
            @if(!$textExists)
                <div class="row-span-2 text-center w-full">
            @else
                <div class="row-span-2 text-center w-full mt-8 xl:mt-0">
            @endif
                <img class="border border-zinc-300 shadow-xs dark:shadow-md dark:border-zinc-600 rounded-md max-h-72 xl:max-h-none mb-8 xl:mb-0 mx-auto" src="{{ $pictureUrl }}" alt="{{ __('messages.pictureOf') . ' ' . $candidate->firstname . ' ' . $candidate->lastname }}" />
            </div>
        @endif
    </div>
    @if(!$textExists && $candidate->picture == '')
        <div class="flex flex-col gap-4">
    @else
        <div class="flex flex-col mt-8 gap-4">
    @endif
        @if(!$textExists)
            <flux:callout color="sky" icon="info" heading="{{ __('messages.candidate_notice_other_language') }}" />
        @endif
        <flux:callout variant="danger" icon="circle-alert" heading="{{ __('messages.candidate_notice_content') }}" />
    </div>
</div>
