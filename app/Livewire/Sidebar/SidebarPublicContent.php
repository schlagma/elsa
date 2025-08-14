<?php

namespace App\Livewire\Sidebar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SidebarPublicContent extends Component
{
    public function render(Request $request)
    {
        $electionState = DB::table('elections')
            ->select('candidates_exist', 'all_votes_counted')
            ->where('id', $request->election)
            ->first();
        
        $committees = DB::table('committees')
            ->select('id','name')
            ->whereJsonContains('elections', (int) $request->election)
            ->orderBy('priority', 'asc')
            ->get();

        return view('livewire.sidebar.sidebar-public-content', [
            'electionID' => $request->election,
            'candidatesExist' => $electionState->candidates_exist,
            'allVotesCounted' => $electionState->all_votes_counted,
            'committees' => $committees,
        ]);
    }
}
