<?php

namespace App\Livewire\Admin\Lists;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ListsIndex extends Component
{
    use WithPagination;

    public $election = "";
    public $committee = "";

    public function render()
    {
        $query = DB::table('lists')
            ->join('elections', 'lists.election', '=', 'elections.id')
            ->join('committees', 'lists.committee', '=', 'committees.id')
            ->select('lists.id', 'lists.name', 'elections.name as election', 'committees.name as committee');

        if ($this->election != "") {
            $query->where('lists.election', $this->election);
        }
        if ($this->committee != "") {
            $query->where('lists.committee', $this->committee);
        }
        $lists = $query->paginate(10);

        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();

        return view('livewire.admin.lists.lists-index', [
            'elections' => $elections,
            'committees' => $committees,
            'lists' => $lists,
        ]);
    }
}
