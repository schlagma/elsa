<?php

namespace App\Livewire\Admin\Questions;

use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class QuestionsAdd extends Component
{
    public $election = '';

    public $committee = '';

    public $questionsDE = [''];

    public $questionsEN = [''];

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
        array_push($this->questionsDE, '');
        array_push($this->questionsEN, '');
    }

    public function removeQuestion(int $index)
    {
        array_splice($this->questionsDE, $index, 1);
        array_splice($this->questionsEN, $index, 1);
    }

    protected function rules(): array
    {
        return [
            'election' => 'required|integer|exists:elections,id',
            'committee' => 'required|integer|exists:committees,id',
            'questionsDE' => 'array',
            'questionsDE.*' => 'nullable|string|max:1000',
            'questionsEN' => 'array',
            'questionsEN.*' => 'nullable|string|max:1000',
        ];
    }

    public function save()
    {
        $this->validate();

        $questions = [];
        array_push($questions, $this->questionsDE);
        array_push($questions, $this->questionsEN);

        DB::table('questions')->updateOrInsert([
            'election' => $this->election,
            'committee' => $this->committee,
            'questions' => json_encode($questions),
        ]);

        Flux::toast(variant: 'success', text: __('admin.added'));
        $this->redirect('/admin/questions', navigate: true);
    }
}
