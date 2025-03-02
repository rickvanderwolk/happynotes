<?php

namespace app\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TestMenu extends Component
{
    public $selectedEmojis = [];
    public $excludedEmojis = [];
    public $searchQuery = null;
    public $originalRoute = null;

    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function mount() {
        $this->originalRoute = session('original_route_name', request()->route()->getName());
        $this->updateFilter();
    }

    public function updateFilter() {
        $user = Auth::user();
        $selectedEmojis = $user->selected_emojis ?? [];
        $excludedEmojis = $user->excluded_emojis ?? [];
        $searchQuery = $user->search_query ?? null;

        if (is_string($selectedEmojis)) {
            $selectedEmojis = json_decode($selectedEmojis, true) ?? [];
        }
        if (is_string($excludedEmojis)) {
            $excludedEmojis = json_decode($excludedEmojis, true) ?? [];
        }

        $this->selectedEmojis = $selectedEmojis;
        $this->excludedEmojis = $excludedEmojis;
        $this->searchQuery = $searchQuery;
        $this->render();
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
