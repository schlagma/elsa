<div class="p-6 sm:p-8 pb-0!">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('candidacy.myCandidacies') }}</h1>
        </div>
    </div>
    <div class="mt-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @if (count($candidacies) > 0)
            @foreach ($candidacies as $item)
            <a
                wire:navigate
                href="{{ route('candidacy-edit', ['id' => $item->id, 'election' => $electionID]) }}"
                class="px-4 py-3 bg-zinc-50 dark:bg-zinc-800 hover:bg-zinc-100 dark:hover:bg-zinc-700 border border-solid border-zinc-200 dark:border-white/10 rounded-md shadow-xs"
            >
                <span class="block font-semibold mb-1">{{ json_decode($item->election_name)[0] }}</span>
                <span class="block">{{ json_decode($item->committee_name)[0] }}</span>
                @if($item->approved)
                    <flux:separator class="my-3" />
                    <div>
                        <flux:badge color="green" icon="circle-check">{{ __('admin.approved') }}</flux:badge>
                    </div>
                @endif
            </a>
            @endforeach
        @else
            <p>{{ __('candidacy.noCandidacies') }}</p>
        @endif
    </div>
</div>