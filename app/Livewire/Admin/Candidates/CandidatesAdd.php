<?php

namespace App\Livewire\Admin\Candidates;

use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\Entry;
use Livewire\Attributes\Layout;
use Livewire\Component;

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

    protected function rules(): array
    {
        return [
            'election' => 'required|integer|exists:elections,id',
            'committee' => 'required|integer|exists:committees,id',
            'list' => 'nullable|integer|exists:lists,id',
            'candidates' => 'required|array|min:1',
            'candidates.*.email' => 'required|email|max:255',
            'candidates.*.faculty' => 'required|integer|exists:faculties,id',
            'candidates.*.course' => 'required|integer|exists:courses,id',
        ];
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
        $this->validate();

        $candidates = $this->candidates->toArray();
        foreach ($candidates as $candidate) {
            try {
                $entry = Entry::where('mail', '=', $candidate['email'])->first();
            } catch (LdapRecordException $e) {
                Log::error('Connecting to LDAP failed.');

                continue;
            }

            if (! $entry) {
                Log::error($candidate['email'].' not found in LDAP.');

                continue;
            }

            DB::table('candidates')->updateOrInsert([
                'election' => $this->election,
                'committee' => $this->committee,
                'lastname' => $entry->getFirstAttribute('sn'),
                'firstname' => $entry->getFirstAttribute('givenname'),
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
        }

        Flux::toast(variant: 'success', text: __('admin.added'));
        $this->redirect('/admin/candidates', navigate: true);
    }
}
