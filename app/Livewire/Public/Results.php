<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class Results extends Component
{
    public function render(Request $request)
    {    
        $election = DB::table('elections')
            ->select('name', 'public')
            ->where('id', $request->election)
            ->first();

        if (!$election->public) {
            abort('403');
        }
    
        $committee = DB::table('committees')
            ->select('name', 'lists', 'seats', 'seats_deputy')
            ->where('id', $request->committee)
            ->first();
    
        $lists = DB::table('lists')
            ->select('id', 'name', 'seats', 'seats_deputy')
            ->where('committee', $request->committee)
            ->where('election', $request->election)
            ->get();
    
        $candidates = DB::table('candidates')
            ->join('courses', 'candidates.course', '=', 'courses.id')
            ->select('candidates.id','candidates.lastname','candidates.firstname','candidates.list','candidates.votes','candidates.resigned','courses.name')
            ->where('candidates.election', $request->election)
            ->where('candidates.committee', $request->committee)
            ->where('candidates.approved', true)
            ->orderBy('candidates.votes', 'desc')
            ->get();

        $results = DB::table('results')
            ->select('eligible_voters', 'ballots_cast', 'ballots_invalid')
            ->where('election', $request->election)
            ->where('committee', $request->committee)
            ->first();

        return view('livewire.public.results', [
            'electionID' => $request->election,
            'electionName' => json_decode($election->name),
            'committeeID' => $request->committee,
            'candidates' => $candidates,
            'results' => $results,
            'lists' => $lists,
            'committee' => $committee,
        ]);

        return view('livewire.public.results');
    }
}
