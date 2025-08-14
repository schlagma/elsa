<?php

namespace App\Livewire\Admin\Questions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class QuestionsEdit extends Component
{
    #[Locked]
    public int $id;

    public int $election;
    public int $committee;
    public array $questionsDE;
    public array $questionsEN;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    
        $questions = DB::table('questions')
            ->select('questions')
            ->where('id', $this->id)
            ->first();

        if ($questions->questions) {
            $this->questionsDE = json_decode($questions->questions)[0];
            $this->questionsEN = json_decode($questions->questions)[1];
        }
    }

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.questions.questions-edit', [
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

        DB::table('questions')->where('id', $this->id)->update([
            'questions' => json_encode($questions),
            'election' => $this->election,
            'committee' => $this->committee,
        ]);
        
        Toaster::success('admin.updated');
    }
}
