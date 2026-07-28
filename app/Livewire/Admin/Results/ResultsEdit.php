<?php

namespace App\Livewire\Admin\Results;

use Flux\Flux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

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
        $this->validate();

        DB::table('results')->where('id', $this->id)->update([
            'election' => $this->election,
            'committee' => $this->committee,
            'eligible_voters' => $this->eligibleVoters,
            'ballots_cast' => $this->ballotsCast,
            'ballots_invalid' => $this->ballotsInvalid,
        ]);

        Flux::toast(variant: 'success', text: __('admin.updated'));
    }
}
