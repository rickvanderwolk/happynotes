<?php

namespace App\Http\Controllers;

final class FilterController extends Controller
{
    public function index(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('filter');
    }

    public function search(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('search');
    }
}
