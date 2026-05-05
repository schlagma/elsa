<flux:dropdown>
    <flux:button icon:trailing="chevron-down">
        @foreach($elections as $item)
            @if($electionID == $item->id)
                @if(app()->getLocale() === 'de')
                    {{ json_decode($item->name)[0] }}
                @elseif(app()->getLocale() === 'en')
                    {{ json_decode($item->name)[1] }}
                @endif
            @endif
        @endforeach
    </flux:button>
    <flux:menu>
        <flux:menu.radio.group>
            @foreach($elections as $item)
                <flux:menu.radio
                    wire:navigate
                    href="{{ route('election', ['election' => $item->id]) }}"
                    :checked="$electionID == $item->id"
                >
                    @if(app()->getLocale() === 'de')
                        {{ json_decode($item->name)[0] }}
                    @elseif(app()->getLocale() === 'en')
                        {{ json_decode($item->name)[1] }}
                    @endif
                </flux:menu.radio>
            @endforeach
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>