<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileExportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/register', function () {
//    abort(403, 'Registration is temporarily disabled.');
//});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verificatiemail verzonden!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

$defaultAppMiddlewares = ['auth:sanctum', config('jetstream.auth_session')];
if (config('app.force_email_verification')) {
    $defaultAppMiddlewares[] = 'verified';
}

Route::middleware($defaultAppMiddlewares)->group(function () {
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu.show');

    Route::get('/', [NoteController::class, 'index'])->name('dashboard');
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.show');
    Route::post('/notes', [NoteController::class, 'store'])->name('note.store');
    Route::get('/notes/new', [NoteController::class, 'create'])->name('note.create');
    Route::get('/notes/{id}', [NoteController::class, 'show'])->name('note.show');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
    Route::get('/notes/{id}/title', [NoteController::class, 'formTitle'])->name('note.title.show');
    Route::post('/notes/{id}/title', [NoteController::class, 'storeTitle'])->name('note.title.store');
    Route::get('/notes/{id}/emojis', [NoteController::class, 'formEmojis'])->name('note.emojis.show');
    Route::post('/notes/{id}/emojis', [NoteController::class, 'storeEmojis'])->name('note.emojis.store');
    Route::get('/notes/{id}/body', [NoteController::class, 'formBody'])->name('note.body.show');
    Route::post('/notes/{id}/body', [NoteController::class, 'storeBody'])->name('note.body.store');

    Route::get('/filter', [FilterController::class, 'index'])->name('filter.show');
    Route::get('/filter/exclude', [FilterController::class, 'index'])->name('filter.exclude.show');
    Route::get('/filter/search', [FilterController::class, 'search'])->name('filter.search.show');

    Route::get('/user/export', [ProfileExportController::class, 'export'])->name('user.export.notes.create');
});
