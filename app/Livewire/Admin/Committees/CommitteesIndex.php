<?php

namespace App\Livewire\Admin\Committees;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CommitteesIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $committees = DB::table('committees')->paginate(10);

        return view('livewire.admin.committees.committees-index', [
            'committees' => $committees,
        ]);
    }
}
