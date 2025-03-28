<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

final class ExportUserDataForm extends Component
{
    public function render(): \Illuminate\View\View|View
    {
        return view('livewire.export-user-data-form');
    }
}
