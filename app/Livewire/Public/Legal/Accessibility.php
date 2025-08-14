<?php

namespace App\Livewire\Public\Legal;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.legal')]
class Accessibility extends Component
{
    public function render()
    {
        $legalTexts = DB::table('legal_texts')->select('accessibility')->where('id', 1)->first();
        return view('livewire.public.legal.accessibility', [
            'accessibility' => json_decode($legalTexts->accessibility),
        ]);
    }
}
