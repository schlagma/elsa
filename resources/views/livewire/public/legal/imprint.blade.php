<div class="infotext p-6 sm:p-8 dark:text-white">
    <h1>{{ __('common.imprint') }}</h1>
    @if(app()->getLocale() == "en")
        {!! Illuminate\Support\Str::markdown($imprint[1]) !!}
    @else
        {!! Illuminate\Support\Str::markdown($imprint[0]) !!}
    @endif
</div>