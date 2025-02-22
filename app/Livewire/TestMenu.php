<?php

namespace app\Livewire;

use Livewire\Component;

class TestMenu extends Component
{
    public $selectedEmojis = [];
    public $excludedEmojis = [];
    public $searchQuery = null;

    public function mount(
        $selectedEmojis = [],
        $excludedEmojis = [],
        $searchQuery = null
    ) {
        if (is_string($selectedEmojis)) {
            $selectedEmojis = json_decode($selectedEmojis, true) ?? [];
        }
        $this->selectedEmojis = $selectedEmojis;
        if (is_string($excludedEmojis)) {
            $excludedEmojis = json_decode($excludedEmojis, true) ?? [];
        }
        $this->excludedEmojis = $excludedEmojis;
        $this->searchQuery = $searchQuery;
    }

    public function render()
    {
        return view('livewire.test-menu', [
            'selectedEmojis' => $this->selectedEmojis,
            'excludedEmojis' => $this->excludedEmojis,
            'searchQuery' => $this->searchQuery,
        ]);
    }
}
