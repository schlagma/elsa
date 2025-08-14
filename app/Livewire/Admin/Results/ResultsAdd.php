<?php

namespace App\Livewire\Admin\Results;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class ResultsAdd extends Component
{
    public int $election;
    public int $committee;
    public int $eligibleVoters;
    public int $ballotsCast;
    public int $ballotsInvalid;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.results.results-add', [
            'elections' => $elections,
            'committees' => $committees,
        ]);
    }

    public function save()
    {
        DB::table('results')->updateOrInsert([
            'election' => $this->election,
            'committee' => $this->committee,
            'eligible_voters' => $this->eligibleVoters,
            'ballots_cast' => $this->ballotsCast,
            'ballots_invalid' => $this->ballotsInvalid,
        ]);

        Toaster::success('admin.added');
        $this->redirect('/admin/results', navigate: true);
    }
}
