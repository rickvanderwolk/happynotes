<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TextFilter extends Component
{
    public ?string $search_query;
    public bool $search_query_only = false;

    protected $casts = [
        'search_query_only' => 'boolean',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->search_query = $user->search_query;
        $this->search_query_only = $user->search_query_only;
    }

    public function updatedSearchQuery()
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['search_query' => $this->search_query]);
            $this->dispatch('filterUpdated');
        }
    }

    public function updatedSearchQueryOnly()
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['search_query_only' => $this->search_query_only]);
            $this->dispatch('filterUpdated');
        }
    }

    public function render()
    {
        return view('livewire.text-filter', [
            'search_query' => $this->search_query,
        ]);
    }
}
