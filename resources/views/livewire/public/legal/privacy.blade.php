<div class="infotext p-6 sm:p-8 dark:text-white">
    <h1>{{ __('common.privacyPolicy') }}</h1>
    @if(app()->getLocale() == "en")
        {!! clean(Illuminate\Support\Str::markdown($privacy[1]), 'markdown') !!}
    @else
        {!! clean(Illuminate\Support\Str::markdown($privacy[0]), 'markdown') !!}
    @endif
</div>