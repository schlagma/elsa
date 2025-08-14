<?php

namespace App\Livewire\Admin\Elections;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class ElectionsAdd extends Component
{
    public string $nameDE = "";
    public string $nameEN = "";
    public string $infotextDE = "";
    public string $infotextEN = "";
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

    public function save()
    {
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

        Toaster::success('admin.added');
        $this->redirect('/admin/elections', navigate: true);
    }
}
