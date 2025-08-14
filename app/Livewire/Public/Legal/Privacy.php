<?php

namespace App\Livewire\Public\Legal;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.legal')]
class Privacy extends Component
{
    public function render()
    {
        $legalTexts = DB::table('legal_texts')->select('privacy')->where('id', 1)->first();
        return view('livewire.public.legal.privacy', [
            'privacy' => json_decode($legalTexts->privacy),
        ]);
    }
}
