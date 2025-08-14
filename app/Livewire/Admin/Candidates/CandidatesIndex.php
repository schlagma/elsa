<?php

namespace App\Livewire\Admin\Candidates;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CandidatesIndex extends Component
{
    use WithPagination;

    public $lastname;
    public $firstname;
    public $election;
    public $faculty;
    public $committee;

    public function render()
    {
        $query = DB::table('candidates')
            ->join('elections', 'candidates.election', '=', 'elections.id')
            ->join('faculties', 'candidates.faculty', '=', 'faculties.id')
            ->join('committees', 'candidates.committee', '=', 'committees.id')
            ->select(
                'candidates.id',
                'candidates.lastname',
                'candidates.firstname',
                'elections.name as election',
                'faculties.name as faculty',
                'committees.name as committee',
                'candidates.approved',
            );
        
        if ($this->lastname != "") {
            $query->where('lastname', 'like', '%' . $this->lastname . '%');
        }
        if ($this->firstname != "") {
            $query->where('firstname', 'like', '%' . $this->firstname . '%');
        }
        if ($this->election != "") {
            $query->where('candidates.election', $this->election);
        }
        if ($this->faculty != "") {
            $query->where('candidates.faculty', $this->faculty);
        }
        if ($this->committee != "") {
            $query->where('candidates.committee', $this->committee);
        }
        
        $candidates = $query->orderBy('candidates.lastname')->paginate(10);

        $elections = DB::table('elections')->orderByDesc('id')->get();
        $faculties = DB::table('faculties')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.candidates.candidates-index', [
            'elections' => $elections,
            'faculties' => $faculties,
            'committees' => $committees,
            'candidates' => $candidates,
        ]);
    }
}
