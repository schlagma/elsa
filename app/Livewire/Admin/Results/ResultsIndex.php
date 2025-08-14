<?php

namespace App\Livewire\Admin\Results;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ResultsIndex extends Component
{
    use WithPagination;

    public $election = "";
    public $committee = "";
    
    public function render()
    {
        $query = DB::table('results')
            ->join('elections', 'results.election', '=', 'elections.id')
            ->join('committees', 'results.committee', '=', 'committees.id')
            ->select('results.id', 'elections.name as election', 'committees.name as committee');

        if ($this->election != "") {
            $query->where('election', $this->election);
        }
        if ($this->committee != "") {
            $query->where('committee', $this->committee);
        }
        $results = $query->paginate(10);

        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.results.results-index', [
            'elections' => $elections,
            'committees' => $committees,
            'results' => $results,
        ]);
    }
}
