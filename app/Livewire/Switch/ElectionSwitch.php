<?php

namespace App\Livewire\Switch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ElectionSwitch extends Component
{
    public string $election;

    public function render(Request $request)
    {
        $elections = DB::table('elections')
            ->select('id', 'name')
            ->where('public', true)
            ->orderByDesc('id')
            ->get();

        return view('livewire.switch.election-switch', [
            'elections' => $elections,
            'electionID' => $request->election,
        ]);
    }

    public function switchElection($election)
    {
        return redirect()->route('public-infos', ['election' => $election]);
    }
}
