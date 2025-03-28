<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class ProgressBar extends Component
{
    public $idNote = null;
    public $progress = null;

    protected $listeners = ['noteUpdated' => 'updateProgress'];

    public function mount($idNote = null): void
    {
        $this->idNote = $idNote;
        $this->updateProgress();
    }

    public function updateProgress(): void
    {
        $note = Note::find($this->idNote);
        if ($note) {
            $this->progress = $note->progress;
            $this->render();
        }
    }

    public function render(): View
    {
        return view('livewire.progress-bar', [
            'progress' => $this->progress,
        ]);
    }
}
