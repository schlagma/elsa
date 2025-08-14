<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class ElectionInfo extends Component
{
    public function render(Request $request)
    {
        $election = DB::table('elections')
            ->select('infotext', 'public')
            ->where('id', $request->election)
            ->first();

        if (!$election->public) {
            abort('403');
        }
        
        return view('livewire.public.election-info', [
            'infotext' => json_decode($election->infotext, true),
        ]);
    }
}
