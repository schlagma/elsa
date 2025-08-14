<?php

namespace App\Livewire\Public;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class CommitteeInfo extends Component
{
    public function render(Request $request)
    {
        $electionID = $request->election;
        $committeeID = $request->id;
    
        $election = DB::table('elections')
            ->select('public')
            ->where('id', $electionID)
            ->first();

        if (!$election->public) {
            abort('403');
        }
    
        $committee = DB::table('committees')
            ->select('name', 'description', 'logo')
            ->where('id', $committeeID)
            ->first();

        if ($committee->logo) {
            $pictureUrl = Storage::disk('local')->temporaryUrl('committee-logos/' . $committee->logo . '.svg', now()->addMinutes(5));
        } else {
            $pictureUrl = null;
        }

        return view('livewire.public.committee-info', [
            'electionID' => $electionID,
            'committee' => $committee,
            'pictureUrl' => $pictureUrl,
        ]);
    }
}
