<?php

namespace App\Livewire\Admin\Candidates;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class CandidatesAdd extends Component
{
    public $election;
    public $committee;
    public $list;
    public $candidates;

    public function mount()
    {
        $this->fill([
            'candidates' => collect([[
                'email' => '',
                'faculty' => null,
                'course' => null,
            ]]),
        ]);
    }

    public function render()
    {
        $elections = DB::table('elections')->orderByDesc('id')->get();
        $committees = DB::table('committees')->get();
        $lists = DB::table('lists')
            ->where('election', $this->election)
            ->where('committee', $this->committee)
            ->get();

        $faculties = DB::table('faculties')->get();
        $courses = DB::table('courses')->get();

        return view('livewire.admin.candidates.candidates-add', [
            'elections' => $elections,
            'committees' => $committees,
            'lists' => $lists,
            'faculties' => $faculties,
            'courses' => $courses,
        ]);
    }

    public function addCandidate()
    {
        $this->candidates->push([
            'name' => '',
            'faculty' => '',
            'course' => '',
        ]);
    }

    public function removeCandidate(int $index)
    {
        $this->candidates->pull($index);
    }

    public function save()
    {
        $candidates = $this->candidates->toArray();
        foreach ($candidates as $candidate) {
            $ds = ldap_connect(config('app.uni_ldap_host'));
            if ($ds) {
                $filter = "(|(mail=" . $candidate['email'] . "))";
                $result = ldap_search($ds, config('app.uni_ldap_base'), $filter);
                $info = ldap_get_entries($ds, $result);

                if ($info['count'] == 1) {
                    DB::table('candidates')->updateOrInsert([
                        'election' => $this->election,
                        'committee' => $this->committee,
                        'lastname' => $info[0]['sn'][0],
                        'firstname' => $info[0]['givenname'][0],
                        'email' => $candidate['email'],
                        'picture' => null,
                        'course' => $candidate['course'],
                        'faculty' => $candidate['faculty'],
                        'list' => $this->list,
                        'answers' => null,
                        'candidacy_received' => date('Y-m-d H:i:s'),
                        'approved' => false,
                        'votes' => null,
                        'resigned' => false,
                    ]);
                } else {
                    Log::error($email . " not found in LDAP.");
                }
            } else {
                Log::error("Connecting to LDAP failed.");
            }
        }

        Toaster::success('admin.added');
        $this->redirect('/admin/candidates', navigate: true);
    }
}
