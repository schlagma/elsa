<?php

namespace App\Livewire\Candidacy;

use App\Mail\CandidacyReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('layouts.form')]
class Candidacy extends Component
{
    #[Locked]
    public int $electionID;

    #[Locked]
    public string $lastname;

    #[Locked]
    public string $firstname;

    #[Locked]
    public string $email;

    public $committee;
    public $list;

    public function mount(Request $request)
    {
        $this->electionID = $request->election;
    }

    public function render(Request $request)
    {
        $this->firstname = auth()->user()->firstname;
        $this->lastname = auth()->user()->lastname;
        $this->email = auth()->user()->email;
    
        $committees = DB::table('committees')
            ->select('id','name')
            ->whereJsonContains('elections', (int) $this->electionID)
            ->orderBy('id', 'asc')
            ->get();
        
        $lists = DB::table('lists')
            ->where('election', $this->electionID)
            ->where('committee', $this->committee)
            ->get();

        if (count($lists) == 0) {
            $this->list = null;
        }
        
        $faculties = DB::table('faculties')->where('active', true)->orderBy('id')->get();
        $courses = DB::table('courses')->where('active', true)->orderBy('id')->get();

        $elections = DB::table('elections')
            ->select('id', 'name')
            ->where('public', true)
            ->orderByDesc('id')
            ->get();

        $election = DB::table('elections')->where('id', $this->electionID)->first();

        $now = date("Y-m-d H:i:s");
        if (!($now > $election->candidacy_begin && $now < $election->candidacy_end)) {
            abort('403');
        }
    
        return view('livewire.candidacy.candidacy', [
            'election' => $election,
            'elections' => $elections,
            'electionID' => $this->electionID,
            'faculties' => $faculties,
            'courses' => $courses,
            'committees' => $committees,
            'lists' => $lists,
        ]);
    }

    public function save()
    {
        DB::table('candidacies')->updateOrInsert([
            'election' => $this->electionID,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'committee' => $this->committee,
            'list' => $this->list,
        ]);

        Toaster::success('candidacy.candidacySubmitted');

        Mail::to($this->email)->send(new CandidacyReceived);
    }
}
