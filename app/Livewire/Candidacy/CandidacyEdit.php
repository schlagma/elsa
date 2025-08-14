<?php

namespace App\Livewire\Candidacy;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.form')]
class CandidacyEdit extends Component
{
    #[Locked]
    public int $id;
    
    public string $firstname;
    public string $lastname;
    public string $email;
    public int $faculty;
    public int $course;
    public int $election;
    public int $committee;
    public ?int $list = null;
    public array $answersDE = [];
    public array $answersEN = [];
    public int $votes;
    public bool $resigned;
    public $picture;
    public $pictureUrl;
    public $imageCropped;

    public function mount(Request $request)
    {
        $this->id = $request->id;

        $candidate = DB::table('candidates')->where('id', $this->id)->first();
        $election = DB::table('elections')->where('id', $candidate->election)->first();

        $now = date("Y-m-d H:i:s");
        if (!($now > $election->candidacy_begin && $now < $election->candidacy_end)) {
            abort('403');
        }

        if ($candidate->email != auth()->user()->email) {
            abort('403');
        }

        $this->firstname = $candidate->firstname;
        $this->lastname = $candidate->lastname;
        $this->email = $candidate->email;
        $this->faculty = $candidate->faculty;
        $this->course = $candidate->course;
        $this->election = $candidate->election;
        $this->committee = $candidate->committee;
        $this->list = $candidate->list;

        $questions = DB::table('questions')
            ->select('questions')
            ->where('election', $this->election)
            ->where('committee', $this->committee)
            ->first();

        if ($candidate->answers != null) {
            $this->answersDE = json_decode($candidate->answers)[0];
            $this->answersEN = json_decode($candidate->answers)[1];
        } else {
            for ($i = 0; $i < count(json_decode($questions->questions)[0]); $i++) {
                array_push($this->answersDE, "");
                array_push($this->answersEN, "");
            }
        }
        
        $this->votes = $candidate->votes;
        $this->resigned = $candidate->resigned;
        if ($candidate->picture) {
            $this->pictureUrl = Storage::disk('local')->temporaryUrl('candidates/' . $candidate->picture . '.avif', now()->addMinutes(5));
        }
    }

    public function render()
    {
        $faculties = DB::table('faculties')->get();
        $courses = DB::table('courses')->get();
        $elections = DB::table('elections')->get();
        $committees = DB::table('committees')->get();
        $lists = DB::table('lists')
            ->where('election', $this->election)
            ->where('committee', $this->committee)
            ->get();

        $questions = DB::table('questions')
            ->select('questions')
            ->where('election', $this->election)
            ->where('committee', $this->committee)
            ->first();

        return view('livewire.candidacy.candidacy-edit', [
            'faculties' => $faculties,
            'courses' => $courses,
            'elections' => $elections,
            'committees' => $committees,
            'lists' => $lists,
            'questions' => json_decode($questions->questions),
            'pictureUrl' => $this->pictureUrl,
        ]);
    }

    public function save()
    {
        $answers = [];
        array_push($answers, $this->answersDE);
        array_push($answers, $this->answersEN);

        DB::table('candidates')->where('id', $this->id)->update([
            'answers' => json_encode($answers),
        ]);

        Toaster::success('admin.updated');
    }

    public function saveImage()
    {
        $imgID = Str::uuid();
        $imgB64 = str_replace('data:image/jpeg;base64,', '', $this->imageCropped);
        $imgDecoded = base64_decode($imgB64);
        $img = imagecreatefromstring($imgDecoded);
        $imgSize = 600;
        $imgFileName = $imgID . '.avif';
        $width = imagesx($img);
        $height = imagesy($img);
        $thumb = imagecreatetruecolor($imgSize, ($imgSize / $width) * $height);
        imagecopyresized($thumb, $img, 0, 0, 0, 0, $imgSize, ($imgSize / $width) * $height, $width, $height);

        ob_start();
        imageavif($thumb, NULL);
        $imgResult = ob_get_clean();

        Storage::disk('local')->put('candidates/' . $imgFileName, $imgResult);
        DB::table('candidates')->where('id', $this->id)->update([
            'picture' => $imgID,
        ]);

        $this->pictureUrl = Storage::disk('local')->temporaryUrl('candidates/' . $imgFileName, now()->addMinutes(5));

        Toaster::success('admin.pictureAdded');
    }

    public function removeImage()
    {
        DB::table('candidates')->where('id', $this->id)->update([
            'picture' => null,
        ]);
        Storage::disk('local')->delete('candidates/' . $this->picture . '.avif');

        $this->pictureUrl = null;

        Toaster::success('admin.pictureRemoved');
    }
}
