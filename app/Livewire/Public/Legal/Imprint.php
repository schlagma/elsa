<?php

namespace App\Livewire\Public\Legal;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.legal')]
class Imprint extends Component
{
    public function render()
    {
        $legalTexts = DB::table('legal_texts')->select('imprint')->where('id', 1)->first();
        return view('livewire.public.legal.imprint', [
            'imprint' => json_decode($legalTexts->imprint),
        ]);
    }
}
