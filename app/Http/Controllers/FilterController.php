<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

final class FilterController extends Controller
{
    public function index(): View
    {
        return view('filter');
    }

    public function search(): View
    {
        return view('search');
    }
}
