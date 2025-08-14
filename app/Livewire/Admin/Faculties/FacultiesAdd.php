<?php

namespace App\Livewire\Admin\Faculties;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class FacultiesAdd extends Component
{
    public string $nameDE = "";
    public string $nameEN = "";
    public array $facultyElections = [];
    public bool $active = true;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.faculties.faculties-add', [
            'elections' => $elections,
        ]);
    }

    public function save()
    {
        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);

        DB::table('faculties')->updateOrInsert([
            'name' => json_encode($name),
            'elections' => json_encode($this->facultyElections),
            'active' => $this->active,
        ]);

        Toaster::success('admin.added');
        $this->redirect('/admin/faculties', navigate: true);
    }
}
