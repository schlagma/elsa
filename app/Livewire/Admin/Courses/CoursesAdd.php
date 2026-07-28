<?php

namespace App\Livewire\Admin\Courses;

use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CoursesAdd extends Component
{
    public string $nameDE = '';

    public string $nameEN = '';

    public array $courseElections = [];

    public bool $active = true;

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();

        return view('livewire.admin.courses.courses-add', [
            'elections' => $elections,
        ]);
    }

    protected function rules(): array
    {
        return [
            'nameDE' => 'required|string|max:255',
            'nameEN' => 'required|string|max:255',
            'courseElections' => 'array',
            'courseElections.*' => 'exists:elections,id',
            'active' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        $name = [];
        array_push($name, $this->nameDE);
        array_push($name, $this->nameEN);

        DB::table('courses')->updateOrInsert([
            'name' => json_encode($name),
            'elections' => json_encode($this->courseElections),
            'active' => $this->active,
        ]);

        Flux::toast(variant: 'success', text: __('admin.added'));
        $this->redirect('/admin/courses', navigate: true);
    }
}
