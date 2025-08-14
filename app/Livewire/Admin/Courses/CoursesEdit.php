<?php

namespace App\Livewire\Admin\Courses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class CoursesEdit extends Component
{
    #[Locked]
    public int $id;

    public string $nameDE;
    public string $nameEN;

    public array $courseElections;
    public bool $active;

    public function mount(Request $request)
    {
        $this->id = $request->id;
    }

    public function render()
    {
        $course = DB::table('courses')->where('id', $this->id)->first();
        $this->nameDE = json_decode($course->name)[0];
        $this->nameEN = json_decode($course->name)[1];
        $this->courseElections = json_decode($course->elections);
        $this->active = $course->active;

        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.courses.courses-edit', [
            'elections' => $elections,
        ]);
    }

    public function save()
    {
        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);

        DB::table('courses')->where('id', $this->id)->update([
            'name' => json_encode($name),
            'elections' => json_encode($this->courseElections),
            'active' => $this->active,
        ]);
        
        Toaster::success('admin.updated');
    }
}
