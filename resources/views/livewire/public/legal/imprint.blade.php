<div class="infotext p-6 sm:p-8 dark:text-white">
    <h1>{{ __('common.imprint') }}</h1>
    @if(app()->getLocale() == "en")
        {!! clean(Illuminate\Support\Str::markdown($imprint[1]), 'markdown') !!}
    @else
        {!! clean(Illuminate\Support\Str::markdown($imprint[0]), 'markdown') !!}
    @endif
</div>