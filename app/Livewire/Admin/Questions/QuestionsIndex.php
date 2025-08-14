<?php

namespace App\Livewire\Admin\Questions;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class QuestionsIndex extends Component
{
    use WithPagination;

    public $election = "";
    public $committee = "";

    public function render()
    {
        $query = DB::table('questions')
            ->join('elections', 'questions.election', '=', 'elections.id')
            ->join('committees', 'questions.committee', '=', 'committees.id')
            ->select('questions.id', 'elections.name as election', 'committees.name as committee');

        if ($this->election != "") {
            $query->where('questions.election', $this->election);
        }
        if ($this->committee != "") {
            $query->where('questions.committee', $this->committee);
        }
        $questions = $query->paginate(10);

        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.questions.questions-index', [
            'elections' => $elections,
            'committees' => $committees,
            'questions' => $questions,
        ]);
    }
}
