<?php

namespace App\Livewire;

use Livewire\Component;

class ProgressBar extends Component
{
    public $percentage = 0;

    public function mount($percentage = 0)
    {
        $this->percentage = $percentage;
    }

    public function render()
    {
        return view('livewire.progress-bar', [
            'percentage' => $this->percentage,
        ]);
    }
}
