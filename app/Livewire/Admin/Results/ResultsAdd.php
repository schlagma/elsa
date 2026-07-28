<?php

namespace App\Livewire\Admin\Results;

use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ResultsAdd extends Component
{
    public int $election;

    public int $committee;

    public int $eligibleVoters;

    public int $ballotsCast;

    public int $ballotsInvalid;

    protected function rules(): array
    {
        return [
            'election' => 'required|integer|exists:elections,id',
            'committee' => 'required|integer|exists:committees,id',
            'eligibleVoters' => 'required|integer|min:0',
            'ballotsCast' => 'required|integer|min:0|lte:eligibleVoters',
            'ballotsInvalid' => 'required|integer|min:0|lte:ballotsCast',
        ];
    }

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
        $this->validate();

        DB::table('results')->updateOrInsert([
            'election' => $this->election,
            'committee' => $this->committee,
            'eligible_voters' => $this->eligibleVoters,
            'ballots_cast' => $this->ballotsCast,
            'ballots_invalid' => $this->ballotsInvalid,
        ]);

        Flux::toast(variant: 'success', text: __('admin.added'));
        $this->redirect('/admin/results', navigate: true);
    }
}
