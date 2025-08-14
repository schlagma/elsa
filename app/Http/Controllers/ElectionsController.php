<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectionsController extends Controller
{
    public function forwardToCurrentElection() {
        $latestElectionID = DB::table('elections')
            ->select('id')
            ->orderByDesc('id')
            ->limit(1)
            ->get();
    
        return redirect()->route('public-infos', ['election' => json_decode($latestElectionID, true)[0]['id']]);
    }

    public function forwardToCurrentCandidacy() {
        $latestElectionID = DB::table('elections')
            ->select('id')
            ->orderByDesc('id')
            ->limit(1)
            ->get();
    
        return redirect()->route('candidacy', ['election' => json_decode($latestElectionID, true)[0]['id']]);
    }
}
