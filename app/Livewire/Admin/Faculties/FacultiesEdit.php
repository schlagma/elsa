<?php

namespace App\Livewire\Admin\Faculties;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class FacultiesEdit extends Component
{
    #[Locked]
    public int $id;

    public string $nameDE;
    public string $nameEN;

    public array $facultyElections;
    public bool $active;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    }

    public function render()
    {
        $faculty = DB::table('faculties')->where('id', $this->id)->first();
        $this->nameDE = json_decode($faculty->name)[0];
        $this->nameEN = json_decode($faculty->name)[1];
        $this->facultyElections = json_decode($faculty->elections);
        $this->active = $faculty->active;

        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.faculties.faculties-edit', [
            'elections' => $elections,
        ]);
    }

    public function save()
    {
        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);

        DB::table('faculties')->where('id', $this->id)->update([
            'name' => json_encode($name),
            'elections' => json_encode($this->facultyElections),
            'active' => $this->active,
        ]);
        
        Toaster::success('admin.updated');
    }
}
