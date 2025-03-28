<?php

namespace App\Livewire;

use Livewire\Component;

final class ExportUserDataForm extends Component
{
    public function render(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('livewire.export-user-data-form');
    }
}
