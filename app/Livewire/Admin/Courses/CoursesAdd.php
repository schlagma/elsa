<?php

namespace App\Livewire\Admin\Courses;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class CoursesAdd extends Component
{
    public string $nameDE = "";
    public string $nameEN = "";
    public array $courseElections = [];
    public bool $active = true;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.courses.courses-add', [
            'elections' => $elections,
        ]);
    }

    public function save()
    {
        $name = [];
        array_push($name, $nameDE);
        array_push($name, $nameEN);

        DB::table('courses')->updateOrInsert([
            'name' => json_encode($name),
            'elections' => json_encode($this->courseElections),
            'active' => $this->active,
        ]);

        Toaster::success('admin.added');
        $this->redirect('/admin/courses', navigate: true);
    }
}
