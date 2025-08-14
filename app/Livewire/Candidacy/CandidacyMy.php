<?php

namespace App\Livewire\Candidacy;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.form')]
class CandidacyMy extends Component
{
    public function render()
    {
        $now = date("Y-m-d H:i:s");
        $candidacies = DB::table('candidates')
            ->join('elections', 'candidates.election', '=', 'elections.id')
            ->join('committees', 'candidates.committee', '=', 'committees.id')
            ->select('candidates.id', 'elections.name as election_name', 'committees.name as committee_name', 'elections.candidacy_edit_begin', 'elections.candidacy_edit_end')
            ->where('email', auth()->user()->email)
            ->where('elections.candidacy_edit_begin', '<', $now)
            ->where('elections.candidacy_edit_end', '>', $now)
            ->get();

        return view('livewire.candidacy.candidacy-my', [
            'candidacies' => $candidacies,
        ]);
    }
}
