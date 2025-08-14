<?php

namespace App\Livewire\Admin\Questions;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class QuestionsAdd extends Component
{
    public $election = "";
    public $committee = "";
    public $questionsDE = [""];
    public $questionsEN = [""];

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.questions.questions-add', [
            'elections' => $elections,
            'committees' => $committees,
        ]);
    }

    public function addQuestion()
    {
        array_push($this->questionsDE, "");
        array_push($this->questionsEN, "");
    }

    public function removeQuestion(int $index)
    {
        array_splice($this->questionsDE, $index, 1);
        array_splice($this->questionsEN, $index, 1);
    }

    public function save()
    {
        $questions = [];
        array_push($questions, $this->questionsDE);
        array_push($questions, $this->questionsEN);

        DB::table('questions')->updateOrInsert([
            'election' => $this->election,
            'committee' => $this->committee,
            'questions' => json_encode($questions),
        ]);

        Toaster::success('admin.added');
        $this->redirect('/admin/questions', navigate: true);
    }
}
