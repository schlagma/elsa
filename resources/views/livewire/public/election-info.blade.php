<div class="infotext p-6 sm:p-8 dark:text-white">
    @if(app()->getLocale() == "en")
        {!! Illuminate\Support\Str::markdown($infotext[1]) !!}
    @else
        {!! Illuminate\Support\Str::markdown($infotext[0]) !!}
    @endif
</div>