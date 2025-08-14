<?php

namespace App\Livewire\Admin\Committees;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class CommitteesAdd extends Component
{
    public string $nameDE = "";
    public string $nameEN = "";
    public string $infotextDE = "";
    public string $infotextEN = "";
    public int $seats = 0;
    public int $seatsDeputy = 0;
    public array $committeeElections = [];
    public bool $lists = false;
    public bool $listsQuoted = false;
    public bool $active = true;
    public int $priority = 10;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.committees.committees-add', [
            'elections' => $elections,
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

        DB::table('committees')->updateOrInsert([
            'name' => json_encode($name),
            'infotext' => json_encode($infotext),
            'seats' => $this->seats,
            'seats_deputy' => $this->seatsDeputy,
            'elections' => json_encode($this->comitteeElections),
            'lists' => $this->lists,
            'lists_quoted' => $this->listsQuoted,
            'active' => $this->active,
            'priority' => $this->priority,
        ]);

        Toaster::success('admin.added');
        $this->redirect('/admin/committees', navigate: true);
    }
}
