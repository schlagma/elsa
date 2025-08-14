<?php

namespace App\Livewire\Admin\Faculties;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class FacultiesIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $faculties = DB::table('faculties')->paginate(10);

        return view('livewire.admin.faculties.faculties-index', [
            'faculties' => $faculties,
        ]);
    }
}
