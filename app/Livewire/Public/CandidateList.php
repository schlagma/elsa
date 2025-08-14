<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class CandidateList extends Component
{
    public function render(Request $request)
    {
        $electionID = $request->election;
        $committeeID = $request->committee;
    
        $election = DB::table('elections')
            ->select('public', 'all_votes_counted')
            ->where('id', $electionID)
            ->first();

        if (!$election->public) {
            abort('403');
        }

        if ($election->all_votes_counted) {
            redirect()->route('public-results', [
                'election' => $electionID,
                'committee' => $committeeID
            ]);
        }

        $committee = DB::table('committees')
            ->select('name', 'lists', 'seats', 'seats_deputy')
            ->where('id', $committeeID)
            ->first();
    
        $lists = DB::table('lists')
            ->select('id', 'name', 'seats', 'seats_deputy')
            ->where('committee', $committeeID)
            ->where('election', $electionID)
            ->first();
    
        $candidates = DB::table('candidates')
            ->join('courses', 'candidates.course', '=', 'courses.id')
            ->select('candidates.id','candidates.lastname','candidates.firstname','candidates.list','courses.name')
            ->where('candidates.election', $electionID)
            ->where('candidates.committee', $committeeID)
            ->where('candidates.approved', true)
            ->orderBy('candidates.lastname', 'asc')
            ->get();
    
        return view('livewire.public.candidate-list', [
            'electionID' => $electionID,
            'committeeID' => $committeeID,
            'candidates' => $candidates,
            'lists' => $lists,
            'committee' => $committee,
        ]);
    }
}
