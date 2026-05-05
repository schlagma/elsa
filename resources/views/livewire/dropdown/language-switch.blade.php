<flux:dropdown>
    <flux:button icon:trailing="chevron-down">
        <x-icon name="flag-language-{{ app()->getLocale() }}" class="size-4" />
    </flux:button>
    <flux:menu>
        @foreach(config('app.locales') as $key => $locale)
            <flux:menu.item
                wire:navigate
                href="{{ route('language', ['language' => $key]) }}"
                class="flex w-full items-center"
                :current="app()->getLocale() === $key"
            >
                <span aria-hidden="true" class="mr-3">
                    <x-icon name="flag-language-{{ $key }}" class="size-4" />
                </span>
                {{ $locale['name'] }}
            </flux:menu.item>
        @endforeach
    </flux:menu>
</flux:dropdown>
