<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class ProgressBar extends Component
{
    public $idNote = null;
    public $progress = null;

    protected $listeners = ['noteUpdated' => 'updateProgress'];

    public function mount($idNote = null)
    {
        $this->idNote = $idNote;
        $this->updateProgress();
    }

    public function updateProgress()
    {
        $note = Note::find($this->idNote);
        if ($note) {
            $this->progress = $note->progress;
            $this->render();
        }
    }

    public function render()
    {
        return view('livewire.progress-bar', [
            'progress' => $this->progress,
        ]);
    }
}
