<div class="infotext p-6 sm:p-8 dark:text-white">
    @if(app()->getLocale() == "en")
        {!! clean(Illuminate\Support\Str::markdown($infotext[1]), 'markdown') !!}
    @else
        {!! clean(Illuminate\Support\Str::markdown($infotext[0]), 'markdown') !!}
    @endif
</div>