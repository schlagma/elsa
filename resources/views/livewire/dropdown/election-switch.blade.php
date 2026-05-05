<flux:dropdown>
    <flux:button variant="ghost" icon="vote" />
    <flux:menu>
        @foreach($elections as $item)
            <flux:menu.item
                wire:navigate
                href="{{ route('election', ['election' => $item->id]) }}"
                :current="$electionID == $item->id"
            >
                @if(app()->getLocale() === 'de')
                    {{ json_decode($item->name)[0] }}
                @elseif(app()->getLocale() === 'en')
                    {{ json_decode($item->name)[1] }}
                @endif
            </flux:menu.item>
        @endforeach
    </flux:menu>
</flux:dropdown>