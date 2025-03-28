<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

final class FilterController extends Controller
{
    public function index(): \Illuminate\View\View|View
    {
        return view('filter');
    }

    public function search(): \Illuminate\View\View|View
    {
        return view('search');
    }
}
