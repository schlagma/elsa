<?php

namespace App\Livewire\Admin\Committees;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class CommitteesEdit extends Component
{
    #[Locked]
    public int $id;

    public string $nameDE;
    public string $nameEN;

    public string $infotextDE;
    public string $infotextEN;

    public int $seats;
    public int $seatsDeputy;
    public array $committeeElections;
    public bool $lists;
    public bool $listsQuoted;
    public bool $active;
    public int $priority;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    }

    public function render()
    {
        $committee = DB::table('committees')->where('id', $this->id)->first();
        $this->nameDE = json_decode($committee->name)[0];
        $this->nameEN = json_decode($committee->name)[1];
        $this->infotextDE = json_decode($committee->description)[0];
        $this->infotextEN = json_decode($committee->description)[1];
        $this->seats = $committee->seats;
        $this->seatsDeputy = $committee->seats_deputy;
        $this->committeeElections = json_decode($committee->elections);
        $this->lists = $committee->lists;
        $this->listsQuoted = $committee->lists_quoted;
        $this->active = $committee->active;
        $this->priority = $committee->priority;

        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.committees.committees-edit', [
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

        DB::table('committees')->where('id', $this->id)->update([
            'name' => json_encode($name),
            'description' => json_encode($infotext),
            'seats' => $this->seats,
            'seats_deputy' => $this->seatsDeputy,
            'elections' => json_encode($this->committeeElections),
            'lists' => $this->lists,
            'lists_quoted' => $this->listsQuoted,
            'active' => $this->active,
            'priority' => $this->priority,
        ]);
        
        Toaster::success('admin.updated');
    }
}
