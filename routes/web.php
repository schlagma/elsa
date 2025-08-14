<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ElectionsController;
use App\Http\Controllers\LanguageController;

$availableLanguages = Config::get('app.available_locales');
$lang = Request::getPreferredLanguage($availableLanguages);
if ($lang) Config::set('app.locale', $lang);

// Public Routes
Route::get('/', [ElectionsController::class, 'forwardToCurrentElection']);
//Route::get('/infos', [ElectionsController::class, 'getInfosForElection']);
Route::get('/{election}/infos', \App\Livewire\Public\ElectionInfo::class)->name('public-infos');
Route::get('/{election}/committee/{id}', \App\Livewire\Public\CommitteeInfo::class)->name('public-committee');
Route::get('/{election}/committee/{committee}/candidates', \App\Livewire\Public\CandidateList::class)->name('public-candidates');
Route::get('/{election}/committee/{committee}/candidate/{id}', \App\Livewire\Public\Candidate::class)->name('public-candidate');
Route::get('/{election}/committee/{committee}/results', \App\Livewire\Public\Results::class)->name('public-results');
Route::get('/candidacy', [ElectionsController::class, 'forwardToCurrentCandidacy']);

Route::get('/imprint', \App\Livewire\Public\Legal\Imprint::class)->name('imprint');
Route::get('/privacy', \App\Livewire\Public\Legal\Privacy::class)->name('privacy');
Route::get('/accessibility', \App\Livewire\Public\Legal\Accessibility::class)->name('accessibility');

// Protected Routes
Route::group(['middleware'=>['auth']], function() {
    Route::get('/{election}/candidacy', \App\Livewire\Candidacy\Candidacy::class)->name('candidacy');

    Route::get('/candidacy/my', \App\Livewire\Candidacy\CandidacyMy::class)->name('candidacy-my');
    Route::get('/candidacy/{id}/edit', \App\Livewire\Candidacy\CandidacyEdit::class)->name('candidacy-edit');

    Route::get('/admin', [AdminController::class, 'forwardToElectionsIndex'])->name('admin-dashboard')->can('election-commission');

    Route::get('/admin/elections', \App\Livewire\Admin\Elections\ElectionsIndex::class)->name('admin-elections-index')->can('election-commission');
    Route::get('/admin/elections/new', \App\Livewire\Admin\Elections\ElectionsAdd::class)->name('admin-elections-add')->can('election-commission');
    Route::get('/admin/elections/{id}/edit', \App\Livewire\Admin\Elections\ElectionsEdit::class)->name('admin-elections-edit')->can('election-commission');

    Route::get('/admin/committees', \App\Livewire\Admin\Committees\CommitteesIndex::class)->name('admin-committees-index')->can('election-commission');
    Route::get('/admin/committees/new', \App\Livewire\Admin\Committees\CommitteesAdd::class)->name('admin-committees-add')->can('election-commission');
    Route::get('/admin/committees/{id}/edit', \App\Livewire\Admin\Committees\CommitteesEdit::class)->name('admin-committees-edit')->can('election-commission');

    Route::get('/admin/courses', \App\Livewire\Admin\Courses\CoursesIndex::class)->name('admin-courses-index')->can('election-commission');
    Route::get('/admin/courses/new', \App\Livewire\Admin\Courses\CoursesAdd::class)->name('admin-courses-add')->can('election-commission');
    Route::get('/admin/courses/{id}/edit', \App\Livewire\Admin\Courses\CoursesEdit::class)->name('admin-courses-edit')->can('election-commission');

    Route::get('/admin/faculties', \App\Livewire\Admin\Faculties\FacultiesIndex::class)->name('admin-faculties-index')->can('election-commission');
    Route::get('/admin/faculties/new', \App\Livewire\Admin\Faculties\FacultiesAdd::class)->name('admin-faculties-add')->can('election-commission');
    Route::get('/admin/faculties/{id}/edit', \App\Livewire\Admin\Faculties\FacultiesEdit::class)->name('admin-faculties-edit')->can('election-commission');

    Route::get('/admin/lists', \App\Livewire\Admin\Lists\ListsIndex::class)->name('admin-lists-index')->can('election-commission');
    Route::get('/admin/lists/new', \App\Livewire\Admin\Lists\ListsAdd::class)->name('admin-lists-add')->can('election-commission');
    Route::get('/admin/lists/{id}/edit', \App\Livewire\Admin\Lists\ListsEdit::class)->name('admin-lists-edit')->can('election-commission');

    Route::get('/admin/questions', \App\Livewire\Admin\Questions\QuestionsIndex::class)->name('admin-questions-index')->can('election-commission');
    Route::get('/admin/questions/new', \App\Livewire\Admin\Questions\QuestionsAdd::class)->name('admin-questions-add')->can('election-commission');
    Route::get('/admin/questions/{id}/edit', \App\Livewire\Admin\Questions\QuestionsEdit::class)->name('admin-questions-edit')->can('election-commission');

    Route::get('/admin/candidates', \App\Livewire\Admin\Candidates\CandidatesIndex::class)->name('admin-candidates-index')->can('election-commission');
    Route::get('/admin/candidates/new', \App\Livewire\Admin\Candidates\CandidatesAdd::class)->name('admin-candidates-add')->can('election-commission');
    Route::get('/admin/candidate/{id}/edit', \App\Livewire\Admin\Candidates\CandidatesEdit::class)->name('admin-candidates-edit')->can('election-commission');
    
    Route::get('/admin/results', \App\Livewire\Admin\Results\ResultsIndex::class)->name('admin-results-index')->can('election-commission');
    Route::get('/admin/results/new', \App\Livewire\Admin\Results\ResultsAdd::class)->name('admin-results-add')->can('election-commission');
    Route::get('/admin/results/{id}/edit', \App\Livewire\Admin\Results\ResultsEdit::class)->name('admin-results-edit')->can('election-commission');

    Route::get('/admin/legal-texts', \App\Livewire\Admin\Legal\LegalTextsEdit::class)->name('admin-legal-texts-edit')->can('admin');
});

// Service Routes
Route::get('/language/{language}', [\App\Livewire\Switch\LanguageSwitch::class, 'switchLanguage'])->name('language');
Route::get('/election/{election}', [\App\Livewire\Switch\ElectionSwitch::class, 'switchElection'])->name('election');
