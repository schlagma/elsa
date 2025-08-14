<?php

namespace App\Livewire\Admin\Legal;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
class LegalTextsEdit extends Component
{
    public string $imprintDE = "";
    public string $imprintEN = "";
    public string $privacyDE = "";
    public string $privacyEN = "";
    public string $accessibilityDE = "";
    public string $accessibilityEN = "";

    public function render()
    {
        $legalTexts = DB::table('legal_texts')->where('id', 1)->first();
        $this->imprintDE = json_decode($legalTexts->imprint)[0];
        $this->imprintEN = json_decode($legalTexts->imprint)[1];
        $this->privacyDE = json_decode($legalTexts->privacy)[0];
        $this->privacyEN = json_decode($legalTexts->privacy)[1];
        $this->accessibilityDE = json_decode($legalTexts->accessibility)[0];
        $this->accessibilityEN = json_decode($legalTexts->accessibility)[1];

        return view('livewire.admin.legal.legal-texts-edit');
    }

    public function save()
    {
        $imprint = [];
        array_push($imprint, $this->imprintDE);
        array_push($imprint, $this->imprintEN);

        $privacy = [];
        array_push($privacy, $this->privacyDE);
        array_push($privacy, $this->privacyEN);

        $accessibility = [];
        array_push($accessibility, $this->accessibilityDE);
        array_push($accessibility, $this->accessibilityEN);

        DB::table('legal_texts')->updateOrInsert([
            'id' => 1,
        ], [
            'imprint' => json_encode($imprint),
            'privacy' => json_encode($privacy),
            'accessibility' => json_encode($accessibility),
        ]);

        Toaster::success('admin.updated');
    }
}
