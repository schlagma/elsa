<div class="p-6 sm:p-8 pb-0!">
    <h1>{{ __('candidacy.myCandidacies') }}</h1>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @if (count($candidacies) > 0)
            @foreach ($candidacies as $item)
            <a
                wire:navigate
                href="{{ route('candidacy-edit', ['id' => $item->id]) }}"
                class="px-4 py-3 bg-zinc-100 hover:bg-zinc-200 border border-solid border-zinc-300 rounded-md shadow-sm"
            >
                <span class="block font-semibold mb-1">{{ json_decode($item->election_name)[0] }}</span>
                <span class="block">{{ json_decode($item->committee_name)[0] }}</span>
            </a>
            @endforeach
        @else
            <p>{{ __('candidacy.noCandidacies') }}</p>
        @endif
    </div>
</div>