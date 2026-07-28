<?php

namespace App\Livewire\Admin\Elections;

use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ElectionsAdd extends Component
{
    public string $nameDE = '';

    public string $nameEN = '';

    public string $infotextDE = '';

    public string $infotextEN = '';

    public bool $public = true;

    public bool $candidatesExist = false;

    public bool $allVotesCounted = false;

    public $candidacyBegin;

    public $candidacyEnd;

    public $candidacyEditBegin;

    public $candidacyEditEnd;

    public function render()
    {
        return view('livewire.admin.elections.elections-add');
    }

    protected function rules(): array
    {
        return [
            'nameDE' => 'required|string|max:255',
            'nameEN' => 'required|string|max:255',
            'infotextDE' => 'nullable|string|max:10000',
            'infotextEN' => 'nullable|string|max:10000',
            'public' => 'boolean',
            'candidatesExist' => 'boolean',
            'allVotesCounted' => 'boolean',
            'candidacyBegin' => 'nullable|date',
            'candidacyEnd' => 'nullable|date|after_or_equal:candidacyBegin',
            'candidacyEditBegin' => 'nullable|date',
            'candidacyEditEnd' => 'nullable|date|after_or_equal:candidacyEditBegin',
        ];
    }

    public function save()
    {
        $this->validate();

        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);

        $infotext = [];
        array_push($infotext, $this->infotextDE);
        array_push($infotext, $this->infotextEN);

        DB::table('elections')->updateOrInsert([
            'name' => json_encode($name),
            'infotext' => json_encode($infotext),
            'public' => $this->public,
            'candidates_exist' => $this->candidatesExist,
            'all_votes_counted' => $this->allVotesCounted,
            'candidacy_begin' => $this->candidacyBegin,
            'candidacy_end' => $this->candidacyEnd,
            'candidacy_edit_begin' => $this->candidacyEditBegin,
            'candidacy_edit_end' => $this->candidacyEditEnd,
        ]);

        Flux::toast(variant: 'success', text: __('admin.added'));
        $this->redirect('/admin/elections', navigate: true);
    }
}
