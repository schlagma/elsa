<div class="infotext p-6 sm:p-8 dark:text-white">
    <h1>{{ __('common.privacyPolicy') }}</h1>
    @if(app()->getLocale() == "en")
        {!! Illuminate\Support\Str::markdown($privacy[1]) !!}
    @else
        {!! Illuminate\Support\Str::markdown($privacy[0]) !!}
    @endif
</div>