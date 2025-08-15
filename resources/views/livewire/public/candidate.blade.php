<div class="p-6 sm:p-8 dark:text-white">
    <div>
        <p class="mb-2 dark:text-white">
            @if(app()->getLocale() == "en")
                {{ $electionName[1] }} &rarr;
            @else
                {{ $electionName[0] }} &rarr;
            @endif
            {{ __('messages.candidates') }} &rarr;
            @if ($allVotesCounted)
                <a wire:navigate class="text-black dark:text-white" href="{{ route('public-results', ['election' => $electionID, 'committee' => $committeeID]) }}">@if(app()->getLocale() == "en"){{ $committeeName[1] }}@else{{ $committeeName[0] }}@endif</a></p>
            @else
                <a wire:navigate class="text-black dark:text-white" href="{{ route('public-candidates', ['election' => $electionID, 'committee' => $committeeID]) }}">@if(app()->getLocale() == "en"){{ $committeeName[1] }}@else{{ $committeeName[0] }}@endif</a></p>
            @endif
        <h1 class="!mb-6 dark:text-white">{{ $candidate->firstname }} {{ $candidate->lastname }}</h1>
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
                <img class="border border-zinc-300 shadow-sm dark:shadow-md dark:border-zinc-600 rounded-md max-h-72 xl:max-h-none mb-8 xl:mb-0 mx-auto" src="{{ $pictureUrl }}" alt="{{ __('messages.pictureOf') . ' ' . $candidate->firstname . ' ' . $candidate->lastname }}" />
            </div>
        @endif
    </div>
    @if(!$textExists && $candidate->picture == '')
        <div class="flex flex-col gap-4">
    @else
        <div class="flex flex-col mt-8 gap-4">
    @endif
        @if(!$textExists)
            <div class="grid grid-cols-[auto_1fr] shadow-sm dark:shadow-md col-span-2 dark:text-white">
                <div class="bg-sky-700 p-2 h-full border border-sky-800 rounded-l-md text-white">
                    <span aria-hidden="true">@svg('mdi-information-outline', 'size-6')</span>
                </div>
                <div class="pl-4 py-2 pr-4 bg-zinc-100 dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 border-l-0 rounded-r-md">{{ __('messages.candidate_notice_other_language') }}</div>
            </div>
        @endif
        <div class="grid grid-cols-[auto_1fr] shadow-sm dark:shadow-md col-span-2 dark:text-white">
            <div class="bg-red-600 p-2 h-full border border-red-700 rounded-l-md text-white">
                <span aria-hidden="true">@svg('mdi-alert-circle-outline', 'size-6')</span>
            </div>
            <div class="pl-4 py-2 pr-4 bg-zinc-100 dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 border-l-0 rounded-r-md">{{ __('messages.candidate_notice_content') }}</div>
        </div>
    </div>
</div>
