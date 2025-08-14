<?php

namespace App\Livewire\Admin\Elections;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class ElectionsEdit extends Component
{
    #[Locked]
    public int $id;

    public string $nameDE;
    public string $nameEN;

    public string $infotextDE;
    public string $infotextEN;

    public bool $public;
    public bool $candidatesExist;
    public bool $allVotesCounted;

    public $candidacyBegin;
    public $candidacyEnd;
    public $candidacyEditBegin;
    public $candidacyEditEnd;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    }

    public function render()
    {
        $election = DB::table('elections')->where('id', $this->id)->first();
        $this->nameDE = json_decode($election->name)[0];
        $this->nameEN = json_decode($election->name)[1];
        $this->infotextDE = json_decode($election->infotext)[0];
        $this->infotextEN = json_decode($election->infotext)[1];
        $this->public = $election->public;
        $this->candidatesExist = $election->candidates_exist;
        $this->allVotesCounted = $election->all_votes_counted;
        $this->candidacyBegin = $election->candidacy_begin;
        $this->candidacyEnd = $election->candidacy_end;
        $this->candidacyEditBegin = $election->candidacy_edit_begin;
        $this->candidacyEditEnd = $election->candidacy_edit_end;

        return view('livewire.admin.elections.elections-edit');
    }

    public function save()
    {
        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);
        
        $infotext = [];
        array_push($infotext, $this->infotextDE);
        array_push($infotext, $this->infotextEN);

        DB::table('elections')->where('id', $this->id)->update([
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

        Toaster::success('admin.updated');
    }
}
