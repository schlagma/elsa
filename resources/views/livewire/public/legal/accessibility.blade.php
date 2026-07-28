<div class="infotext p-6 sm:p-8 dark:text-white">
    <h1>{{ __('common.accessibility') }}</h1>
    @if(app()->getLocale() == "en")
        {!! clean(Illuminate\Support\Str::markdown($accessibility[1]), 'markdown') !!}
    @else
        {!! clean(Illuminate\Support\Str::markdown($accessibility[0]), 'markdown') !!}
    @endif
</div>