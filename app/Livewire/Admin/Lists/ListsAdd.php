<?php

namespace App\Livewire\Admin\Lists;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class ListsAdd extends Component
{
    public string $nameDE;
    public string $nameEN;

    public string $infotextDE;
    public string $infotextEN;

    public int $election;
    public int $committee;
    public int $seats = 0;
    public int $seatsDeputy = 0;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.lists.lists-add', [
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
        
        Toaster::success('admin.added');
        $this->redirect('/admin/lists', navigate: true);
    }
}
