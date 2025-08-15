<div class="infotext p-6 sm:p-8 dark:text-white">
    @if($pictureUrl)
    <div class="grid lg:grid-cols-[1fr_12rem] gap-10">
    @else
    <div>
    @endif
        <div>
            @if(app()->getLocale() == "en")
                <h1 class="mb-6! dark:text-white">{{ json_decode($committee->name)[1] }}</h1>
                {!! Illuminate\Support\Str::markdown(json_decode($committee->description)[1]) !!}
            @else
                <h1 class="mb-6! dark:text-white">{{ json_decode($committee->name)[0] }}</h1>
                {!! Illuminate\Support\Str::markdown(json_decode($committee->description)[0]) !!}
            @endif
        </div>
        @if($pictureUrl)
        <div class="flex">
            @if(app()->getLocale() == "en")
            <img class="w-full max-w-48 mx-auto mb-auto" src="{{ $pictureUrl }}" alt="{{ __('messages.logo_of') }} {{ json_decode($committee->name)[1] }}">
            @else
            <img class="w-full max-w-48 mx-auto mb-auto" src="{{ $pictureUrl }}" alt="{{ __('messages.logo_of') }} {{ json_decode($committee->name)[1] }}">
            @endif
        </div>
        @endif
    </div>
</div>
