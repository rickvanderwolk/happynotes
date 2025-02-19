<?php

namespace App\Http\Controllers;

class FilterController extends Controller
{
    public function index()
    {
        return view('filter');
    }

    public function search()
    {
        return view('search');
    }
}
