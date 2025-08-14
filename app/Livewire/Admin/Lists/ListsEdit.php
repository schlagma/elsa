<?php

namespace App\Livewire\Admin\Lists;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class ListsEdit extends Component
{
    #[Locked]
    public int $id;

    public string $nameDE;
    public string $nameEN;

    public string $infotextDE;
    public string $infotextEN;

    public int $election;
    public int $committee;
    public int $seats;
    public int $seatsDeputy;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    }

    public function render()
    {
        $list = DB::table('lists')->where('id', $this->id)->first();
        $this->nameDE = json_decode($list->name)[0];
        $this->nameEN = json_decode($list->name)[1];
        $this->infotextDE = json_decode($list->description)[0];
        $this->infotextEN = json_decode($list->description)[1];
        $this->election = $list->election;
        $this->committee = $list->committee;
        $this->seats = $list->seats;
        $this->seatsDeputy = $list->seats_deputy;

        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.lists.lists-edit', [
            'elections' => $elections,
            'committees' => $committees,
        ]);
    }

    public function save()
    {
        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);
        
        $infotext = [];
        array_push($infotext, $this->infotextDE);
        array_push($infotext, $this->infotextEN);

        DB::table('lists')->where('id', $this->id)->update([
            'name' => json_encode($name),
            'description' => json_encode($infotext),
            'election' => $this->election,
            'committee' => $this->committee,
            'seats' => $this->seats,
            'seats_deputy' => $this->seatsDeputy,
        ]);
        
        Toaster::success('admin.updated');
    }
}
