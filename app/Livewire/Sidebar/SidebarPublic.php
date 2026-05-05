<?php

namespace App\Livewire\Sidebar;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SidebarPublic extends Component
{
    public function render(Request $request)
    {
        $electionState = DB::table('elections')
            ->select(
                'candidates_exist',
                'all_votes_counted',
                'candidacy_begin',
                'candidacy_end',
                'candidacy_edit_begin',
                'candidacy_edit_end'
            )
            ->where('id', $request->election)
            ->first();
        
        $committees = DB::table('committees')
            ->select('id','name')
            ->whereJsonContains('elections', (int) $request->election)
            ->orderBy('priority', 'asc')
            ->get();

        $showCandidacy = false;
        $showEditCandidacy = false;
        $now = new DateTime();
        $candidacyStart = new DateTime($electionState->candidacy_begin);
        $candidacyEnd = new DateTime($electionState->candidacy_end);
        $candidacyEditStart = new DateTime($electionState->candidacy_edit_begin);
        $candidacyEditEnd = new DateTime($electionState->candidacy_edit_end);
        if ($now > $candidacyStart && $now < $candidacyEnd) {
            $showCandidacy = true;
        }
        if ($now > $candidacyEditStart && $now < $candidacyEditEnd) {
            $showEditCandidacy = true;
        }

        return view('livewire.sidebar.sidebar-public', [
            'electionID' => $request->election,
            'committeeID' => $request->committee,
            'candidatesExist' => $electionState->candidates_exist,
            'allVotesCounted' => $electionState->all_votes_counted,
            'committees' => $committees,
            'showCandidacy' => $showCandidacy,
            'showEditCandidacy' => $showEditCandidacy,
        ]);
    }
}
