<?php

namespace App\Livewire\Admin\Elections;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ElectionsIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->paginate(10);

        return view('livewire.admin.elections.elections-index', [
            'elections' => $elections,
        ]);
    }
}
