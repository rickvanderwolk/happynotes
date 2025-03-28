<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class TextFilter extends Component
{
    public ?string $search_query;
    public bool $search_query_only = false;

    protected $casts = [
        'search_query_only' => 'boolean',
    ];

    public function mount(): void
    {
        $user = Auth::user();
        $this->search_query = $user->search_query;
        $this->search_query_only = $user->search_query_only;
    }

    public function updatedSearchQuery(): void
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['search_query' => $this->search_query]);
            $this->dispatch('filterUpdated');
        }
    }

    public function updatedSearchQueryOnly(): void
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['search_query_only' => $this->search_query_only]);
            $this->dispatch('filterUpdated');
        }
    }

    public function render(): View
    {
        return view('livewire.text-filter', [
            'search_query' => $this->search_query,
        ]);
    }
}
