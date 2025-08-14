<?php

namespace App\Livewire\Admin\Results;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class ResultsEdit extends Component
{
    #[Locked]
    public int $id;
    
    public int $election;
    public int $committee;
    public int $eligibleVoters;
    public int $ballotsCast;
    public int $ballotsInvalid;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    }

    public function render()
    {
        $results = DB::table('results')->where('id', $this->id)->first();
        $this->election = $results->election;
        $this->committee = $results->committee;
        $this->eligibleVoters = $results->eligible_voters;
        $this->ballotsCast = $results->ballots_cast;
        $this->ballotsInvalid = $results->ballots_invalid;

        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.results.results-edit', [
            'elections' => $elections,
            'committees' => $committees,
        ]);
    }

    public function save()
    {
        DB::table('results')->where('id', $this->id)->update([
            'election' => $this->election,
            'committee' => $this->committee,
            'eligible_voters' => $this->eligibleVoters,
            'ballots_cast' => $this->ballotsCast,
            'ballots_invalid' => $this->ballotsInvalid,
        ]);

        Toaster::success('admin.updated');
    }
}
