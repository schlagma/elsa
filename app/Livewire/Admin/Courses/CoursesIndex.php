<?php

namespace App\Livewire\Admin\Courses;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CoursesIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $courses = DB::table('courses')->paginate(10);

        return view('livewire.admin.courses.courses-index', [
            'courses' => $courses,
        ]);
    }
}
