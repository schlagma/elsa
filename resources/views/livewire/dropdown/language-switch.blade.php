<flux:dropdown>
    <flux:button icon:trailing="chevron-down">
        @foreach(config('app.locales') as $key => $locale)
            @if(app()->getLocale() === $key)
                <span aria-hidden="true">
                    <x-icon name="flag-language-{{ $key }}" class="size-4" />
                </span>
                <span class="sr-only">{{ $locale['name'] }}</span>
            @endif
        @endforeach
    </flux:button>
    <flux:menu>
        <flux:menu.radio.group>
            @foreach(config('app.locales') as $key => $locale)
                <flux:menu.radio
                    wire:navigate
                    href="{{ route('language', ['language' => $key]) }}"
                    class="flex w-full items-center"
                    :checked="app()->getLocale() === $key"
                >
                    <span aria-hidden="true" class="mr-3">
                        <x-icon name="flag-language-{{ $key }}" class="size-4" />
                    </span>
                    {{ $locale['name'] }}
                </flux:menu.radio>
            @endforeach
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
