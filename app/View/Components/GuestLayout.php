<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

final class GuestLayout extends Component
{
    #[\Override]
    public function render(): View|\Illuminate\Contracts\View\View
    {
        return view('layouts.guest');
    }
}
