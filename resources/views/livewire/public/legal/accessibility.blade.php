<div class="infotext p-6 sm:p-8 dark:text-white">
    <h1>{{ __('common.accessibility') }}</h1>
    @if(app()->getLocale() == "en")
        {!! Illuminate\Support\Str::markdown($accessibility[1]) !!}
    @else
        {!! Illuminate\Support\Str::markdown($accessibility[0]) !!}
    @endif
</div>